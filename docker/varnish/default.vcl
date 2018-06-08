vcl 4.0;
import std;
import xkey;

backend default {
    .host = "web";
    .port = "80";
}

acl invalidators {
    "127.0.0.0"/16;
    "192.168.0.0"/16;
}

acl debuggers {
    "127.0.0.0"/16;
    "192.168.0.0"/16;
}

sub vcl_purge {
    if (req.method == "BAN") {
        if (!client.ip ~ invalidators) {
            return (synth(405, "Method not allowed"));
        }
        ban(req.url);
    }
}

sub vcl_recv {
    set req.backend_hint = default;
    unset req.http.Forwarded;

    if (req.method != "GET" && req.method != "HEAD") {
        return (pass);
    }

    set req.url = std.querysort(req.url);

    return (hash);
}

sub vcl_deliver {
    if (client.ip ~ debuggers) {

    }
}
