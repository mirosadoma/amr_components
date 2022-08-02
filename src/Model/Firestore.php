<?php

namespace App\Models;


use Google\Cloud\Firestore\FieldValue;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Database\Eloquent\Model;

class Firestore extends Model {
  
    public static function soonAdv($adv, $destination ='Auctions' ,$projectId= "harag-ali") {
        try{
          	$db = new FirestoreClient(['projectId' => $projectId,]);
            $fireAdv = $db->collection($destination)->document($adv->id);
            $snapshot  = $fireAdv->snapshot();
            if (!$snapshot->exists()){
                $fireAdv = $fireAdv->create([
                    'bidders' => 0,
                    'status' => "soon",
                    'visitors' => 0,
                ]);
            }
        }catch (\Exception $e){
            var_dump($e);die();
        }
    }

    public static function openAdv($adv, $destination ='Auctions' ,$projectId= "harag-ali") {
        try{
          	$db = new FirestoreClient(['projectId' => $projectId,]);
          	$fireAdv = $db->collection($destination)->document($adv->id);
            $snapshot  = $fireAdv->snapshot();
            if ($snapshot->exists()){
                $fireAdv->update([
                    ['path' => 'status', 'value'  => "open"],
                ]);
            }
        }catch (\Exception $e){
            var_dump($e);die();
        }
    }

  	public static function closeAdv($adv, $destination ='Auctions' ,$projectId= "harag-ali") {
        try{
          	$db = new FirestoreClient(['projectId' => $projectId,]);
          	$fireAdv = $db->collection($destination)->document($adv->id);
            $snapshot  = $fireAdv->snapshot();
            if ($snapshot->exists()){
                $fireAdv->update([
                    ['path' => 'status', 'value'  => "close"],
                ]);
            }
        }catch (\Exception $e){
            var_dump($e);die();
        }
    }

    public static function addAdv($adv_id, $destination ='Auctions' ,$projectId= "harag-ali") {
        try{
          	$db = new FirestoreClient(['projectId' => $projectId,]);
          	$fireAdv = $db->collection($destination)->document($adv_id);
            $snapshot  = $fireAdv->snapshot();
            if ($snapshot->exists()){
                $fireAdv->update([
                    ['path' => 'status', 'value'  => "open"],
                ]);
            }else{
                $fireAdv->create([
                    'bidders' => 0,
                    'status' => "open",
                    'visitors' => 0,
                ]);
            }
        }catch (\Exception $e){
            var_dump($e);die();
        }
    }

    public static function addVisitors($adv, $destination ='Auctions' ,$projectId= "harag-ali") {
        try{
          	$db = new FirestoreClient(['projectId' => $projectId,]);
          	$fireAdv = $db->collection($destination)->document($adv->id);
            $snapshot  = $fireAdv->snapshot();
            if ($snapshot->exists()){
                $num = $snapshot['visitors'] + 1;
                $fireAdv->update([
                    ['path' => 'visitors', 'value'  => $num],
                ]);
            }else {
                self::addAdv($adv->id,$destination,$projectId);
            }
            return 0;
        }catch (\Exception $e){
            var_dump($e);die();
        }
    }

    public static function addBidders($adv_id, $destination ='Auctions' ,$projectId= "harag-ali") {
        try{
          	$db = new FirestoreClient(['projectId' => $projectId,]);
          	$fireAdv = $db->collection($destination)->document($adv_id);
            $snapshot  = $fireAdv->snapshot();
            if ($snapshot->exists()){
                $num = $snapshot['bidders'] + 1;
                $fireAdv->update([
                    ['path' => 'bidders', 'value'  => $num],
                ]);
            }
        }catch (\Exception $e){
            var_dump($e);die();
        }
    }

  	public static function sendRec($adv_id, $rec_path, $time, $collection = "Records", $destination ='Auctions' ,$projectId= "harag-ali") {
        try{
          	$db = new FirestoreClient(['projectId' => $projectId,]);
          	$fireAdv = $db->collection($destination)->document($adv_id)->collection($collection);
              $fireAdv->add([
                'path'              => (string) $rec_path,
                'time'             	=> $time
            ]);
        }catch (\Exception $e){
            var_dump($e);die();
        }
    }
  
    public static function addBid($adv_id , $sender_id , $bid , $time, $destination ='Auctions' ,$projectId= "harag-ali") {
        try{
          	$db = new FirestoreClient(['projectId' => $projectId,]);
          	$fireAdv = $db->collection($destination)->document($adv_id)->collection('Messages');
            $fireAdv->add([
                'adv_id'            => (int) $adv_id,
                'bid'               => (int) $bid,
                'client_id'         => (string) $sender_id,
                'time'             	=> $time
            ]);
        }catch (\Exception $e){
            var_dump($e);die();
        }
    }

    public static function deleteAdv($adv_id, $destination ='Auctions' ,$projectId= "harag-ali") {
        try{
          	$db = new FirestoreClient(['projectId' => $projectId,]);
          	$fireAdv = $db->collection($destination)->document($adv_id)->delete();
            return 1;
        }catch (\Exception $e){
            var_dump($e);die();
        }
    }

    public static function status($adv_id ,$projectId= "harag-ali") {
        try{
          	$db = new FirestoreClient(['projectId' => $projectId,]);
            $query = $db->collection('Auctions')->document($adv_id)->snapshot();
            if ($query->exists()){
              return $query['status'];
            }
            return 0;
        }catch (\Exception $e){
          var_dump($e);die();
        }
    }

    public static function getBids($adv_id , $collection = null ,$destination ='Auctions' ,$projectId= "harag-ali" ) {
        try{
          	$db = new FirestoreClient(['projectId' => $projectId,]);
            $show = $db->collection($destination)->document($adv_id);
            if(!is_null($collection)){
                $query = $show->collection($collection)->orderBy('time','DESC');
                $show = $query->documents();
            };
            return $show;
        }catch (\Exception $e){
          var_dump($e);die();
        }
    }

    // public static function endChat($fire_id , $destination ='Auctions' ,$projectId= "harag-ali") {
    //     try{
    //         $db = new FirestoreClient(['projectId' => $projectId,]);
    //         $fireAdv = $db->collection($destination)->document($fire_id);
    //         $snapshot  = $fireAdv->snapshot();
    //         if ($snapshot->exists()){
    //             $fireAdv->update([
    //                 ['path' => 'is_open', 'value'  => "false"],
    //             ]);
    //         }
    //     }catch (\Exception $e){
    //     var_dump($e);die();
    //     }
    // }

    // public static function documentGetAll($destination ='Auctions' ,$projectId= "harag-ali" ) {
    //     try{
    //         $db = new FirestoreClient(['projectId' => $projectId,]);
    //         $query = $db->collection($destination);
    //         $documents = $query->documents();
    //         return $documents;
    //     }catch (\Exception $e){
    //         var_dump($e);die();
    //     }
    // }
  
  	// public static function getVendor($fire_id ,$projectId= "harag-ali" ) {
    //     try{
    //       	$db = new FirestoreClient(['projectId' => $projectId,]);
    //         $query = $db->collection('Auctions')->document($fire_id)->snapshot();
    //         if(isset($query['vendor_id'])) {
	// 			return $query['vendor_id'];
    //         }else{
    //           return false;
    //         }
    //     }catch (\Exception $e){
    //       var_dump($e);die();
    //     }
    // }
  
  	// public static function advDelete($fire_id , $projectId= "harag-ali" ) {
    //     try{
    //         $db = new FirestoreClient(['projectId' => $projectId]);
    //         $query = $db->collection('Auctions')->document($fire_id)->delete();
    //         return 1;
    //     }catch (\Exception $e){
    //         var_dump($e);die();
    //     }
    // }

    // public static function documentUpdate($fire_id , $destination ='Auctions' ,$collection = 'Messages' ,$message = null ) {
    //     try{
    //         $messages = app('firebase.firestore')->database()->collection($destination)->document($fire_id)->collection($collection);
    //         $data = [
    //             'content'       => $message['content'],
    //             'created_at'    => $message['created_at'],
    //             'type'          => $message['type'],
    //             'user_id'       => $message['user_id'],
    //         ];
    //         $messages = $messages->add($data);
    //     }catch (\Exception $e){
    //         var_dump($e);die();
    //     }
    // }

//    public static function documentDeleteMessages($fire_id , $destination ='Auctions' ,$collection = 'Messages' ,$projectId= "harag-ali" ) {
//        try{
//            $db = new FirestoreClient(['projectId' => $projectId]);
//            $db = $db->collection($destination)->document($fire_id)->collection($collection);
//            $documents = $db->documents();
//            while (!$documents->isEmpty()) {
//                foreach ($documents as $document) {
//                    $document->reference()->delete();
//                }
//            }
//            $db->delete();
//        }catch (\Exception $e){
//            var_dump($e);die();
//        }
//    }

    // public static function documentAssign($fire_id , $receiver_id = null  , $destination ='Auctions' , $ends_at = null ) {
    //     try{
    //         if(isset($receiver_id)){
    //             app('firebase.firestore')->database()->collection($destination)->document($fire_id)
    //                 ->update([
    //                     ['path' => 'receiver_id', 'value' => (int) $receiver_id],
    //                 ]);
    //         }
    //         if(isset($ends_at)){
    //             app('firebase.firestore')->database()->collection($destination)->document($fire_id)
    //                 ->update([
    //                     ['path' => 'ends_at', 'value' => $ends_at],
    //                 ]);
    //         }
    //     }catch (\Exception $e){
    //         var_dump($e);die();
    //     }
    // }
}
