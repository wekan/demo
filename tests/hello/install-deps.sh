../install-haxelibs/install-haxelibs.sh
sudo apt-get -y install build-essential mono-complete openjdk-11-jdk lua5.3 liblua5.3-dev luarocks
sudo luarocks install lrexlib-pcre
sudo luarocks install environ
sudo luarocks install luasocket
sudo luarocks install luv
sudo luarocks install luautf8

# HashLink deps
sudo apt-get -y install libpng-dev libturbojpeg-dev libvorbis-dev libopenal-dev libsdl2-dev libmbedtls-dev libuv1-dev

mkdir ~/repos
cd ~/repos
git clone https://github.com/HaxeFoundation/hashlink
make
sudo make install

cd ~/repos/hx/tests/hello

# HashLink libs at /usr/local/lib

echo "Add to ~/.bashrc (for haxelink /usr/local/lib, python .local/bin):"
echo "export PATH=~/.local/bin:~/Downloads/haxe:~/Downloads/neko:~/projects/meteor-spk/meteor-spk-0.5.1:$PATH"
echo "export LD_LIBRARY_PATH=$LD_LIBRARY_PATH:~/Downloads/neko:/usr/local/lib"
