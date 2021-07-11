import tink.http.containers.*;
import tink.http.Response;
import tink.web.routing.*;

class Server {
    static function main() {
#if js
        var container = new NodeContainer(8080); 
#elseif php
        var container =  PhpContainer.inst; //use PhpContainer instead of NodeContainer when targeting PHP
#end
        var router = new Router<Root>(new Root());
        container.run(function(req) {
            return router.route(Context.ofRequest(req))
                .recover(OutgoingResponse.reportError);
        });
    }
}

class Root {
    public function new() {}
    
    @:get('/')
    @:get('/$name')
    public function hello(name = 'World')
        return 'Hello, $name!';
}
