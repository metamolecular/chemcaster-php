<?php

class Chemcaster_Transporter
{
    public function __construct( $u, $p ){}

    public function get( $link )
    {
        switch($link->name) {
            case 'root':
            return '{
              "service": {
                "version": "0.1.0"
              },
              "registries": {
                "name": "available registries",
                "uri": "http:\/\/chemcaster.com\/registries",
                "media_type": "application\/vnd.com.chemcaster.Index+json"
              }
            }';
                break;

            case 'available registries':
                return '{
                  "items": [
                    {
                      "name": "bar",
                      "uri": "http:\/\/chemcaster.com\/registries\/30",
                      "media_type": "application\/vnd.com.chemcaster.Registry+json"
                    },
                    {
                      "name": "foo",
                      "uri": "http:\/\/chemcaster.com\/registries\/2",
                      "media_type": "application\/vnd.com.chemcaster.Registry+json"
                    }
                  ],
                  "parent": {
                    "media_type": "application\/vnd.com.chemcaster.Service+json",
                    "name": "root",
                    "uri": "http:\/\/chemcaster.com\/rest"
                  },
                  "create": {
                    "media_type": "application\/vnd.com.chemcaster.Registry+json",
                    "name": "create a new registry",
                    "uri": "http:\/\/chemcaster.com\/registries"
                  }
                }';
                break;
            case 'foo':
            case 'bar':
                return '{
                  "index": {
                    "media_type": "application\/vnd.com.chemcaster.Index+json",
                    "name": "listing of registries",
                    "uri": "http:\/\/chemcaster.com\/registries"
                  },
                  "update": {
                    "media_type": "application\/vnd.com.chemcaster.Registry+json",
                    "name": "update this registry",
                    "uri": "http:\/\/chemcaster.com\/registries\/2"
                  },
                  "structures": {
                    "media_type": "application\/vnd.com.chemcaster.Index+json",
                    "name": "this registry\'s structures",
                    "uri": "http:\/\/chemcaster.com\/registries\/2\/structures"
                  },
                  "registry": {
                    "name": "foo"
                  },
                  "queries": {
                    "media_type": "application\/vnd.com.chemcaster.Index+json",
                    "name": "this registry\'s queries",
                    "uri": "http:\/\/chemcaster.com\/registries\/2\/queries"
                  }
                }';
                break;

            case "this registry's structures":
                return '{
                  "items": [
                    {
                      "media_type": "application\/vnd.com.chemcaster.Structure+json",
                      "name": "woozle",
                      "uri": "http:\/\/chemcaster.com\/structures\/10"
                    },
                    {
                      "media_type": "application\/vnd.com.chemcaster.Structure+json",
                      "name": "bar",
                      "uri": "http:\/\/chemcaster.com\/structures\/5"
                    }
                  ],
                  "create": {
                    "media_type": "application\/vnd.com.chemcaster.Structure+json",
                    "name": "create a structure",
                    "uri": "http:\/\/chemcaster.com\/registries\/2\/structures"
                  },
                  "parent": {
                    "media_type": "application\/vnd.com.chemcaster.Registry+json",
                    "name": "foo",
                    "uri": "http:\/\/chemcaster.com\/registries\/2"
                  }
                }';
                break;
            case 'woozle':
                return '{
                  "index": {
                    "media_type": "application\/vnd.com.chemcaster.Index+json",
                    "name": "structure index",
                    "uri": "http:\/\/chemcaster.com\/registries\/2\/structures"
                  },
                  "update": {
                    "media_type": "application\/vnd.com.chemcaster.Structure+json",
                    "name": "update this structure",
                    "uri": "http:\/\/chemcaster.com\/structures\/10"
                  },
                  "registry": {
                    "media_type": "application\/vnd.com.chemcaster.Registry+json",
                    "name": "foo",
                    "uri": "http:\/\/chemcaster.com\/registries\/2"
                  },
                  "images": {
                    "media_type": "application\/vnd.com.chemcaster.Index+json",
                    "name": "images for this structure",
                    "uri": "http:\/\/chemcaster.com\/structures\/10\/images"
                  },
                  "structure": {
                    "name": "woozle",
                    "molfile": "molfile...",
                    "inchi": "inchi..."
                  },
                  "destroy": {
                    "media_type": "application\/vnd.com.chemcaster.Structure+json",
                    "name": "delete this structure",
                    "uri": "http:\/\/chemcaster.com\/structures\/10"
                  }
                }';
                break;

            case 'this registry\'s queries';
                return '{
                  "items": [

                  ],
                  "create": {
                    "media_type": "application\/vnd.com.chemcaster.Query+json",
                    "name": "create a query",
                    "uri": "http:\/\/chemcaster.com\/registries\/2\/queries"
                  },
                  "parent": {
                    "media_type": "application\/vnd.com.chemcaster.Registry+json",
                    "name": "foo",
                    "uri": "http:\/\/chemcaster.com\/registries\/2"
                  }
                }';
                break;
            default:

                echo "get link name in stub:: " . $link->name . "\n";
        }
    }

    public function post( $link, $json )
    {
        return '{
          "index": {
            "media_type": "application\/vnd.com.chemcaster.Index+json",
            "name": "listing of registries",
            "uri": "https:\/\/chemcaster.com\/registries"
          },
          "update": {
            "media_type": "application\/vnd.com.chemcaster.Registry+json",
            "name": "update this registry",
            "uri": "https:\/\/chemcaster.com\/registries\/45"
          },
          "structures": {
            "media_type": "application\/vnd.com.chemcaster.Index+json",
            "name": "this registry\'s structures",
            "uri": "https:\/\/chemcaster.com\/registries\/45\/structures"
          },
          "registry": {
            "name": "test1"
          },
          "queries": {
            "media_type": "application\/vnd.com.chemcaster.Index+json",
            "name": "this registry\'s queries",
            "uri": "https:\/\/chemcaster.com\/registries\/45\/queries"
          }
        }';
    }

    public function put( $link, $json )
    {

    }
    public function delete( $link )
    {

    }

    public function getLastStatusCode()
    {
        return 200;
    }

}

?>
