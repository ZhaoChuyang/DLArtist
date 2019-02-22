<?php

namespace DLArtist\Http\Controllers;

use Illuminate\Http\Request;

class ModelController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function BingImageSearch(Request $request){
        // Replace with a valid subscription key from your Azure account.
        $accessKey = '3f478837b17641d8bfef316abc8355b1';
        $endpoint = 'https://api.cognitive.microsoft.com/bing/v7.0/images/search';
        $term = $request->input('query');
        function BingImageSearch ($url, $key, $query) {
            /*
             * Prepare the HTTP request.
             * NOTE: Use the key 'http' even if you are making an HTTPS request.
             * See: http://php.net/manual/en/function.stream-context-create.php.
             */
            // Perform the request and receive a response.
            $headers = "Ocp-Apim-Subscription-Key: $key\r\n";
            $options = array ( 'http' => array (
                'header' => $headers,
                'method' => 'GET' ));
            // Perform the request and receive a response.
            $context = stream_context_create($options);
            $result = file_get_contents($url . "?q=" . urlencode($query), false, $context);
            // Extract Bing HTTP headers.
            $headers = array();
            $num=0;
            foreach ($http_response_header as $k => $v) {
                $h = explode(":", $v, 2);
                if (isset($h[1])){
                    if (preg_match("/^BingAPIs-/", $h[0]) || preg_match("/^X-MSEdge-/", $h[0])){
                        $headers[trim($h[0])] = trim($h[1]);
                    }
                }
            }
            return array($headers, $result);
        }
// Validate the subscription key.
        if (strlen($accessKey) == 32) {
            // Makes the request.
            list($headers, $json) = BingImageSearch($endpoint, $accessKey, $term);
            // Prints JSON encoded response.
            //print "\nJSON Response:\n\n";
            return response()->json(['url'=>$json]);
        } else {
            //print("Invalid Bing Search API subscription key!\n");
            //print("Please paste yours into the source code.\n");
        }
    }

    public function sendArticle(Request $request){

    }
}
