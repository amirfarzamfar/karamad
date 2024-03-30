<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdvertisementsCollection;
use App\Http\Resources\BenfitsCollection;
use App\Http\Resources\QuestionsCollection;
use App\Http\Resources\SupportsCollection;
use App\Http\Resources\TipsCollection;
use App\Http\Resources\UserProfileResource;
use App\Models\About;
use App\Models\Karamad_benefit;
use App\Models\Karamad_tip;
use App\Models\Reapeted_question;
use App\Models\User;



class WorkplaceController extends Controller
{

    public function index()
    {
       $user = self::UserProfile();

      $Advertisements = self::Advertisements();

      $Benefits = self::Benefits();

      $Tips = self::Tips();

      $Questions = self::Questions();

      $Supports = self::Supports();

      return [
          'user' => $user,
          'Advertisements' => $Advertisements,
          'Benefits' => $Benefits ,
          'Tips' => $Tips ,
          'Questions'=>$Questions ,
          'Supports'=>$Supports
      ];
    }
    //
    public function Advertisements()
    {
        $recentRecords = User::latest()->take(1)->get();

        $recentRecords = $recentRecords->sortByDesc('id')->values();

        return AdvertisementsCollection::collection($recentRecords);
    }
    //
    public  function Benefits()
    {
        $karamad_benefit = Karamad_benefit::take(2)->get();

        return BenfitsCollection::collection($karamad_benefit);
    }

    public function Tips()
    {
       $karamad_tips = Karamad_tip::paginate(2);

       return TipsCollection::collection($karamad_tips );
    }
    //
    public function Questions()
    {
        $Reapeted_resume = Reapeted_question::all();

        return QuestionsCollection::collection($Reapeted_resume);
    }
    //
    public function Supports()
    {
        $KaramadSupport = About::all();

        return SupportsCollection::collection($KaramadSupport);
    }
    //
    public function UserProfile()
    {
        $id = auth()->id();

        if( $id == !null){
        $user = User::find($id)->first();

        $image = User::find($id)->getMedia();

        $avatar_id = $image[0]->getUrl();

        $user_data = array(
            'user_name' => $user->name ,
            'avatar_url' => $avatar_id
        );

        return new UserProfileResource($user_data);
        }
        return response()->json(null);
    }
}
