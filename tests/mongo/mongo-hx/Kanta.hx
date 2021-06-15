import org.mongodb.Mongo;

class Kanta {
    static public function main() {
        var mongo = new Mongo("localhost", 27019);
        for (users in mongo.wekan.users.find())
        {
          trace(users.username); // assumes that all posts have a title
        }
    }
}
