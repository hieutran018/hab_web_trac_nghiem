<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MatchHistory;
use App\Models\ScoreSingle;
use App\Models\ScoreChallenge;
use App\Models\Ranking;
use App\Models\Notify;
use App\Models\HistoryAnswer;
use Carbon\Carbon;
use App\Models\Level;
use App\Models\TopicQuestion;
use App\Models\Question;
use DB;

class GameController extends Controller
{
    public function createMatchSingle(Request $request){
        $user = $request->user()->id;
        $match = new MatchHistory();
        $match->user_id = $user;
        $match->topic_question_id = $request->topic_question_id;
        $match->level_id = $request->level_id;
        $match->game_mode = 1;
        $match->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $match->save();

        $data = $request->all();
        $count = count($data['list_answer']);
        
        for($i = 0; $i< $count; $i++){
            $answer = new HistoryAnswer();
            $answer->match_id = $match->id;
            $answer->user_id = $user;
            $answer->question_id = $data['list_answer'][$i]['question_id'];
            $answer->answer_id = $data['list_answer'][$i]['answer_id'];
            $answer->save();
        }

        $scoreSingle = new ScoreSingle();
        $scoreSingle->match_id = $match->id;
        $scoreSingle->score = $request->score;
        $scoreSingle->save();

        $updateScoreSingle = Ranking::WHERE('user_id',$user)->first();
        $updateScoreSingle->score_single = $updateScoreSingle->score_single + $request->score;
        $updateScoreSingle->update();
        return response()->json('Lưu lịch sử trận đấu thành công',200);
    }

    public function saveAnswer(Request $request){
        $data = $request->all();
        // dd($data[0]['question_id']);
        $count = count($data);

        for($i = 0; $i< $count; $i++){
            $answer = new HistoryAnswer();
            $answer->match_id = 10;
            $answer->question_id = $data[$i]['question_id'];
            $answer->answer_id = $data[$i]['answer_id'];
            $answer->save();
        }
    }

    public function createMatchChallenge(Request $request){
        $userFrom = $request->user()->id;
        $userTo = $request->user_id_to;
        $match = new MatchHistory();
        $match->user_id = $userFrom;
        $match->topic_question_id = $request->topic_question_id;
        $match->level_id = $request->level_id;
        $match->game_mode = 2;
        $match->status = 1;
        $match->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $match->save();

        $data = $request->all();
        $count = count($data['list_answer']);
        

        for($i = 0; $i< $count; $i++){
            $answer = new HistoryAnswer();
            $answer->match_id = $match->id;
            $answer->user_id = $userFrom;
            $answer->question_id = $data['list_answer'][$i]['question_id'];
            $answer->answer_id = $data['list_answer'][$i]['answer_id'];
            $answer->save();
        }

        $scoreChallenge = new ScoreChallenge();
        $scoreChallenge->match_id = $match->id;
        $scoreChallenge->user_id_from = $userFrom;
        $scoreChallenge->user_id_to = $userTo;
        $scoreChallenge->potin_user_id_from = $request->point_user_id_from;
        $scoreChallenge->potin_user_id_to = 0;
        $scoreChallenge->save();

        $noti = new Notify();
        $noti->user_id_request = $userFrom;
        $noti->notification_id = 1;
        
        $noti->user_id_confirm = $userTo;
        $noti->match_id = $match->id;
        $noti->status = 1;
        $noti->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $noti->save();
        
    }

    public function acceptedGame(Request $request){
        $detailMatch = $request->match_id;
        $match = MatchHistory::WHERE('id',$detailMatch)->first();
        $idTopic = TopicQuestion::WHERE('id',$match->topic_question_id)->first();
        $idLevel = Level::WHERE('id',$match->level_id)->first();
        $lstQuestion = Question::WHERE('topic_id',$idTopic->id)->WHERE('level_id',$idLevel->id)->orderBy(DB::raw('RAND()'))->limit($idLevel->amount_question)->get();
        foreach($lstQuestion as $question)
        {
            $question->answer;
        }
        return response()->json($lstQuestion,200);
        
    }

    public function saveAcceptGameChallenge(Request $request){
        $userId = $request->user()->id;

        $match = new MatchHistory();
        $match->user_id = $userId;
        $match->topic_question_id = $request->topic_id;
        $match->level_id = $request->level_id;
        $match->game_mode = 2;
        $match->status = 0;
        $match->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $match->save();

        $data = $request->all();
        $count = count($data['list_answer']);
        

        for($i = 0; $i< $count; $i++){
            $answer = new HistoryAnswer();
            $answer->match_id = $match->id;
            $answer->user_id = $userId;
            $answer->question_id = $data['list_answer'][$i]['question_id'];
            $answer->answer_id = $data['list_answer'][$i]['answer_id'];
            $answer->save();
        }

        $scoreChallenge = ScoreChallenge::WHERE('match_id',$request->match_id)->first();
        $scoreChallenge->sub_match_id = $match->id;
        $scoreChallenge->potin_user_id_to = $request->point_user_id_to;
        $scoreChallenge->update();
        
        if($scoreChallenge->potin_user_id_from > $scoreChallenge->potin_user_id_to){
            $scoreChallenge->user_id_win = $scoreChallenge->user_id_from;
            $scoreChallenge->update();
        }else if($scoreChallenge->potin_user_id_from < $scoreChallenge->potin_user_id_to){
            $scoreChallenge->user_id_win = $scoreChallenge->user_id_to;
            $scoreChallenge->update();
        }else if($scoreChallenge->potin_user_id_from == $scoreChallenge->potin_user_id_to){
            $scoreChallenge->user_id_win = $scoreChallenge->user_id_from;
            $scoreChallenge->update();
        }
        
        
        $ranking = Ranking::WHERE('user_id',$scoreChallenge->user_id_win)->first();
        $scoreCurrent = $ranking->score_challenge;
        $ranking->score_challenge = $scoreCurrent + 100;
        $ranking->update();

        $noti = new Notify();
        $noti->match_id = $request->match_id;
        $noti->notification_id = 1;
        
        
        return response()->json('Lưu lại trận đấu thành công!',200);
    }

    
}