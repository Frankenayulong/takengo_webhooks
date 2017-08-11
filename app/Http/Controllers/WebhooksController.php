<?php

namespace App\Http\Controllers;
use App\Repository;
use App\WebhookLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
class WebhooksController extends Controller
{
    public function show(Request $request, $API_KEY){
    	if($API_KEY == Config::get('constants.webhooks_key')){
    		$refs = json_decode(json_encode($request->input('refs')));
    		$payload = json_decode(json_encode($request->input('repository')));
    		if(!$refs || !$payload){
    			return 'no payload';
    		}
    		$repo_name = $payload->name;
    		$repo_full_name = $payload->full_name;
    		if(!$repo_name || !$repo_full_name){
    			return 'malformed payload';
    		}

			if($refs != 'refs/heads/master'){
				return 'invalid branch';
			}
    		
    		$repository = Repository::where('name', $repo_name)->first();
    		if(!$repository){
    			return 'repo not recorded';
    		}
    		$outputs = array();
    		$output = shell_exec("git -C $repository->full_path pull origin master");

    		array_push($outputs, $output);
    		$webhookLog = new WebhookLog;
    		$webhookLog->name = $repo_name;
    		$webhookLog->full_name = $repo_full_name;
    		$webhookLog->payload = json_encode($payload);
    		$webhookLog->command_output = json_encode($outputs);
    		$webhookLog->save();
			return 'success';
    	}
    	return 404;
    }
}
