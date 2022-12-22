<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MatchHistory;
use App\Models\Level;
use App\Models\TopicQuestion;
use App\Models\Question;
use App\Models\ScoreSingle;
use App\Models\ScoreChallenge;
use App\Models\HistoryAnswer;
use App\Models\User;

class MatchHistoryController extends Controller
{
    public function getMatchHistory(Request $request){
        $lstMatch = MatchHistory::WHERE('user_id',$request->user_id)->get();
        foreach( $lstMatch as $match){
            
            $match->level_id = Level::WHERE('id',$match->level_id)->get('level_name');
            $match->topic_question_id = TopicQuestion::WHERE('id',$match->topic_question_id)->get('topic_question_name');
            $match->created_at = date('d-m-Y', strtotime($match->created_at));
        }
        return response()->json($lstMatch,200);
    }

    public function getMatchHistorySingleDetail(Request $request){
        $mthD = ScoreSingle::WHERE('match_id',$request->match_id)->first();
        
        $match = MatchHistory::WHERE('id',$request->match_id)->first();
        $match->level_id = Level::WHERE('id',$match->level_id)->get('level_name');
        $match->topic_question_id = TopicQuestion::WHERE('id',$match->topic_question_id)->get('topic_question_name');
        $match->created_at = date('d-m-Y', strtotime($match->created_at));
        $historyAnswer = HistoryAnswer::WHERE('match_id',$request->match_id)->get(['question_id','answer_id']);
        foreach($historyAnswer as $answer){
            $answer->question_id = Question::WHERE('questions.id',$answer->question_id)
            ->join('answer_questions','answer_questions.question_id','=','questions.id')
            ->get(['answer_questions.id','answer_questions.answer_content','answer_questions.question_id','answer_questions.isTrue']);
            
        }
        return response()->json(['match_id'=>$mthD->match_id,
                                'game_mode'=>$match->game_mode,
                                'topic_question'=>$match->topic_question_id,
                                'level_question'=>$match->level_id,
                                'score'=>$mthD->score,
                                'created_at'=>$match->created_at,
                                'historyAnswer'=>$historyAnswer,
                                ],200);
    }

    public function getMatchHistoryChallengeDetail(Request $request){
        $mthD = ScoreChallenge::WHERE('match_id',$request->match_id)->first();
        if(empty($mthD)){
            $mthD = ScoreChallenge::WHERE('sub_match_id',$request->match_id)->first();
            $match = MatchHistory::WHERE('id',$request->match_id)->first();
        $sub_match = MatchHistory::WHERE('id',$mthD->sub_match_id)->first();

        $match->level_id = Level::WHERE('id',$match->level_id)->get('level_name');
        $match->topic_question_id = TopicQuestion::WHERE('id',$match->topic_question_id)->get('topic_question_name');
        $match->created_at = date('d-m-Y', strtotime($match->created_at));
        $historyAnswerFrom = HistoryAnswer::WHERE('match_id',$request->match_id)->get(['question_id','answer_id']);
        foreach($historyAnswerFrom as $answer){
            $answer->question_id = Question::WHERE('questions.id',$answer->question_id)
            ->join('answer_questions','answer_questions.question_id','=','questions.id')
            ->get(['answer_questions.id','answer_questions.answer_content','answer_questions.question_id','answer_questions.isTrue']);
            
        }
        if(!empty($sub_match)){
            $sub_match->level_id = Level::WHERE('id',$sub_match->level_id)->get('level_name');
            $sub_match->topic_question_id = TopicQuestion::WHERE('id',$sub_match->topic_question_id)->get('topic_question_name');
            $sub_match->created_at = date('d-m-Y', strtotime($sub_match->created_at));
            $historyAnswerTo = HistoryAnswer::WHERE('match_id',$sub_match->id)->get(['question_id','answer_id']);
            
            foreach($historyAnswerTo as $answer){
                $answer->question_id = Question::WHERE('questions.id',$answer->question_id)
                ->join('answer_questions','answer_questions.question_id','=','questions.id')
                ->get(['answer_questions.id','answer_questions.answer_content','answer_questions.question_id','answer_questions.isTrue']);
                
            }
        }else{
            $historyAnswerTo = [];
        }
        }else{
        $match = MatchHistory::WHERE('id',$request->match_id)->first();
        $sub_match = MatchHistory::WHERE('id',$mthD->sub_match_id)->first();

        $match->level_id = Level::WHERE('id',$match->level_id)->get('level_name');
        $match->topic_question_id = TopicQuestion::WHERE('id',$match->topic_question_id)->get('topic_question_name');
        $match->created_at = date('d-m-Y', strtotime($match->created_at));
        $historyAnswerFrom = HistoryAnswer::WHERE('match_id',$request->match_id)->get(['question_id','answer_id']);
        foreach($historyAnswerFrom as $answer){
            $answer->question_id = Question::WHERE('questions.id',$answer->question_id)
            ->join('answer_questions','answer_questions.question_id','=','questions.id')
            ->get(['answer_questions.id','answer_questions.answer_content','answer_questions.question_id','answer_questions.isTrue']);
            
        }
        if(!empty($sub_match)){
            $sub_match->level_id = Level::WHERE('id',$sub_match->level_id)->get('level_name');
            $sub_match->topic_question_id = TopicQuestion::WHERE('id',$sub_match->topic_question_id)->get('topic_question_name');
            $sub_match->created_at = date('d-m-Y', strtotime($sub_match->created_at));
            $historyAnswerTo = HistoryAnswer::WHERE('match_id',$sub_match->id)->get(['question_id','answer_id']);
            
            foreach($historyAnswerTo as $answer){
                $answer->question_id = Question::WHERE('questions.id',$answer->question_id)
                ->join('answer_questions','answer_questions.question_id','=','questions.id')
                ->get(['answer_questions.id','answer_questions.answer_content','answer_questions.question_id','answer_questions.isTrue']);
                
            }
        }else{
            $historyAnswerTo = [];
        }
    }
        return response()->json(['match_id'=>$mthD->match_id,
                                'user_id_from'=>$mthD->user_id_from = User::WHERE('id',$mthD->user_id_from)->get('display_name'),
                                'user_id_to'=>$mthD->user_id_to = User::WHERE('id',$mthD->user_id_to)->get('display_name'),
                                'game_mode'=>$match->game_mode,
                                'topic_question'=>$match->topic_question_id,
                                'level_question'=>$match->level_id,
                                'potin_user_id_from'=>$mthD->potin_user_id_from,
                                'user_id_win'=>$mthD->user_id_win,
                                'potin_user_id_to'=>$mthD->potin_user_id_to,
                                'created_at'=>$match->created_at,
                                'historyAnswer_from'=>$historyAnswerFrom,
                                'historyAnswer_to'=>$historyAnswerTo
                                ],200);

    }

    

    
}