rm -rf .build
echo "Creating directory .build:"
mkdir .build/node .build/php .build/python .build/cs .build/java .build/cpp

echo "Building node:"
haxe -js .build/node/wekan.js -lib hxnodejs -main Wekan

echo "Building php:"
haxe -php .build/php -main Wekan

echo "Building python:"
haxe -python .build/python/wekan.py -main Wekan

echo "Building cs (C#):"
# This error is at issue: https://github.com/HaxeFoundation/haxe/issues/6464
#haxelib run hxcs hxcs_build.txt --haxe-version 4300 --feature-level 1 --out cs/server.cs/bin/Server
#Note: dmcs is deprecated, please use mcs instead!
haxe -cs .build/cs -main Wekan

echo "Building java:"
haxe -java .build/java -main Wekan

echo "Building cpp:"
haxe -cpp .build/cpp -main Wekan

