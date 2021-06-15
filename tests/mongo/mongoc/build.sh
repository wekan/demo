export PKG_CONFIG_PATH=/usr/local/lib/pkgconfig
pkg-config --modversion libbson-1.0
pkg-config --modversion libmongoc-1.0

gcc -o find find.c $(pkg-config --cflags --libs libbson-1.0 libmongoc-1.0)
