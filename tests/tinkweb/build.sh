mkdir node php

echo "Building node:"
haxe -js node/server.js -lib hxnodejs -lib tink_web -main Server

echo "Building php:"
haxe -php php -main Server -lib tink_web
