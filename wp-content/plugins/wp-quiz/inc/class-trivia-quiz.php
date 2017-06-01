<?php
/**
 * Override parent 'WP_Quiz' class with trivia quiz specific markup,
 * 
 */
class WP_Quiz_Trivia_Quiz extends WP_Quiz {
	
	public function get_html_questions(){
		
		$questionsHTML 	= '';
	
		if( !empty( $this->questions ) ){	

			if( $this->settings[ 'question_layout' ] == 'single' ){
				$ad_display = 'block';
				$display_continue = 'none';
			}else{
				$ad_display = 'none';
				$display_continue = 'block';
			}
			
			foreach( $this->questions as $key => $question ){
			
				$mediaHTML = '';
				if( $question[ 'mediaType' ] == 'image' ){
					if( !empty( $question[ 'image' ] ) ) {
						$mediaHTML = '<div class="wq_questionImage"><img src="' . esc_url( $question[ 'image' ] ) . '" /><span>'.esc_html( $question[ 'imageCredit' ] ).'</span></div>';
					}
				} else if ( $question[ 'mediaType' ] == 'video' ){
					if( !empty( $question[ 'video' ] ) ){
						if ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $question[ 'video' ], $match ) ){
							if( !empty( $match[ 1 ] ) ){
								$mediaHTML = '<div class="ui embed media-'.$key.'" data-source="youtube" data-id="' . $match[ 1 ] . '"  data-placeholder="'.esc_attr( $question[ 'imagePlaceholder' ] ).'" data-icon="video play"></div>';
							}
						} else if ( preg_match( '#(?:https?://)?(?:www.)?(?:player.)?vimeo.com/(?:[a-z]*/)*([0-9]{6,11})[?]?.*#', $question[ 'video' ], $match ) ) {
							if( !empty( $match[ 1 ] ) ){
								$mediaHTML = '<div class="ui embed media-'.$key.'" data-source="vimeo" data-id="' . $match[ 1 ] . '"  data-placeholder="'.esc_attr( $question[ 'imagePlaceholder' ] ).'" data-icon="video play"></div>';
							}
						} else {
							$mediaHTML = '<div class="ui embed media-'.$key.'" data-url="'.esc_url( $question[ 'video' ] ).'" data-placeholder="'.esc_attr( $question[ 'imagePlaceholder' ] ).'" data-icon="video play"></div>';
						}
						$autoplay = !empty( $question[ 'imagePlaceholder' ] ) ? 'true':'false';
						$mediaHTML .= '<script>jQuery(document).ready(function($){$(".ui.media-'.$key.'").embed({"autoplay":'.$autoplay.'});});</script>'; 
					}
				}
				
				$answersHTML = '';
				if( isset( $question[ 'answers' ] ) ){
					$answersHTML    =   '<div class="wq_answersWrapper">';
					$answersHasImage = false;
					foreach( $question[ 'answers' ] as $answer ){
						if( !empty( $answer[ 'image' ] ) ) {
							$answersHasImage = true;
							$answersHTML = '';
							$answersHTML = '<div class="wq_answersWrapper">';
							break;
						}
				
						$answersHTML .= '
							<div class="wq_singleAnswerCtr wq_IsTrivia" data-crt="' . esc_attr( $answer[ 'isCorrect' ] ) . '" style="background-color:'.esc_attr( $this->settings[ 'background_color' ] ).'; color:' . esc_attr( $this->settings[ 'font_color' ] ) . ';">
								<label class="wq_answerTxtCtr">' . esc_html( $answer[ 'title' ] ) . '</label>
							</div>
						';
					}
			
					if( $answersHasImage ){
						$cols = apply_filters( 'wp_quiz_img_answer_cols', 3 ); // 2 columns if anything else is passed
						if ( 3 === $cols ) {
							$col_class = 'col-md-wq-4';
						} else {
							$col_class = 'col-md-wq-6';
							$cols = 2;
						}
						$i=0;
						$answersHTML .= '<div class="row">';
						foreach( $question[ 'answers' ] as $answer ){
							$answerImgHTML      =   '';
							$answerTitle = '';
							$answerImgHTML = '<div class="wq_answerImgCtr"><img src="' . $answer[ 'image' ] . '"></div>';
							$answerTitle = empty( $answer[ 'title' ] ) ? '&nbsp;' : $answer[ 'title' ];
							$answersHTML .= '
								<div class="'.$col_class.'">	
									<div class="wq_singleAnswerCtr wq_IsTrivia wq_hasImage" data-crt="' . esc_attr( $answer[ 'isCorrect' ] ) . '" style="background-color:'.esc_attr( $this->settings[ 'background_color' ] ).'; color:' . esc_attr( $this->settings[ 'font_color' ] ) . ';">
										' . $answerImgHTML . '
										<label class="wq_answerTxtCtr">' . esc_html( $answerTitle ) . '</label>
									</div>
								</div>
							';
							$i++;
							if ( $i%$cols == 0 ) 
								$answersHTML .= '</div><div class="row">';
						}
						$answersHTML .= '</div>';
					}
					$answersHTML .=   '</div>';
				}	
				
				$display = $key == 0 ? 'block' : 'none';
				if( $this->settings[ 'question_layout' ] == 'single' ){
					$display = 'block';
				}
				$questionsHTML .= '
					<div class="wq_singleQuestionWrapper wq_IsTrivia" style="display:'.$display.';">
						<div class="wq_singleQuestionCtr">
							<div class="wq_questionTextWrapper quiz-clearfix">	
								<div class="wq_questionTextCtr" style="background-color:'.esc_attr( $this->settings[ 'background_color' ] ).'; color:' . esc_attr( $this->settings[ 'font_color' ] ) . ';"> 
									<h4>'. esc_html( $question[ 'title' ] ) . '</h4>
								</div>
							</div>
							<div class="wq_questionMediaCtr" >	
								' . $mediaHTML . '
							</div>
							<div class="wq_questionAnswersCtr">
								' . $answersHTML. '
							</div>
							<div class="wq_triviaQuestionExplanation">
								<div class="wq_ExplanationHead"></div>
								<p class="wq_QuestionExplanationText">' . wp_kses_post( $question[ 'desc' ] ). '</p>
							</div>
						</div>
						<div class="wq_continue" style="display:none;">
							<button class="wq_btn-continue" style="background-color:'.esc_attr( $this->settings[ 'bar_color' ] ).'">'.__( 'Continue &gt;&gt;', 'wp-quiz' ).'</button>
						</div>
					</div>
				';	
			}
		}
		return $questionsHTML;
	}
	
	public function get_html_results(){
		
		$resultsHTML = '';
		$shareHTML = $this->get_html_share();
		if( !empty( $this->results ) ){
			foreach( $this->results as $result ){
				$resultImgHTML = '';
				if( !empty( $result[ 'image' ] ) ){
					$resultImgHTML = '<p><img class="wq_resultImg" src="' . esc_url( $result[ 'image' ] ) . '"/></p>';
				}
				$resultsHTML .= '
					<div style="display:none;" class="wq_singleResultWrapper wq_IsTrivia" data-min="' . esc_attr( $result[ 'min' ] ) . '" data-max="' . esc_attr( $result[ 'max' ] ) . '">
						<span class="wq_quizTitle">' . esc_html( get_the_title( $this->id ) ) . '</span>
						<div class="wq_resultScoreCtr"></div>
						<div class="wq_resultTitle"><strong>' . esc_html( $result[ 'title' ] ) . '</strong></div>
						' . $resultImgHTML .  '
						<div class="wq_resultDesc">' . esc_html( $result[ 'desc' ] ) . '</div>
						' . $shareHTML . '
					</div>
				';
			}
		}
		
		return $resultsHTML;
		
	}

}