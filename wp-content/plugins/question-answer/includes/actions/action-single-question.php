<?php
/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


	add_action( 'qa_action_single_question_main', 'qa_action_single_question_main_function', 10 );
	
	if ( ! function_exists( 'qa_action_single_question_main_function' ) ) {
		function qa_action_single_question_main_function() {
			
			do_action('qa_action_single_question_title');

			
			do_action('qa_action_breadcrumb');
            do_action('qa_action_admin_actions');
			
			do_action('qa_action_single_question_content');
			do_action('qa_action_single_question_social_share');
			do_action('qa_action_single_question_subscriber');
			
			do_action('qa_action_answer_posting');
			
			do_action('qa_action_answer_section');
			
		}
	}
	
	
	add_action( 'qa_action_single_question_title', 'qa_action_single_question_title_function', 10 );
	add_action( 'qa_action_single_question_title', 'qa_action_single_question_view_count_function', 10 );

    add_action( 'qa_action_admin_actions', 'qa_action_admin_actions_function', 10 );

	
	
	add_action( 'qa_action_single_question_meta', 'qa_action_single_question_meta_function', 10 );
	
	add_action( 'qa_action_single_question_content', 'qa_action_single_question_content_function', 20 );
	add_action( 'qa_action_single_question_social_share', 'qa_action_single_question_social_share_function', 20 );	
	add_action( 'qa_action_single_question_subscriber', 'qa_action_single_question_subscriber_function', 20 );
		
	add_action( 'qa_action_answer_section', 'qa_action_answer_section_function', 10 );
	add_action( 'qa_action_single_answer_content', 'qa_action_single_answer_vote_function', 10 );	
	add_action( 'qa_action_single_answer_content', 'qa_action_single_answer_content_function', 10 );
	add_action( 'qa_action_answer_posting', 'qa_action_answer_posting_function', 10 );
	add_action( 'qa_action_single_answer_reply', 'qa_action_single_answer_reply_function', 10 );

	add_action( 'qa_action_single_question_sidebar', 'qa_action_single_question_sidebar_function', 10 );

	
	// Answer action functions
	if ( ! function_exists( 'qa_action_answer_section_function' ) ) {
		function qa_action_answer_section_function() {
			include( QA_PLUGIN_DIR. 'templates/single-question/answer-section.php');
		}
	}
	
	
	if ( ! function_exists( 'qa_action_single_answer_vote_function' ) ) {
		function qa_action_single_answer_vote_function() {
			include( QA_PLUGIN_DIR. 'templates/single-question/answer-vote.php');
		}
	}	
	
	if ( ! function_exists( 'qa_action_single_answer_content_function' ) ) {
		function qa_action_single_answer_content_function() {
			include( QA_PLUGIN_DIR. 'templates/single-question/answer-content.php');
		}
	}
	
	if ( ! function_exists( 'qa_action_answer_posting_function' ) ) {
		function qa_action_answer_posting_function() {
			require_once( QA_PLUGIN_DIR. 'templates/single-question/answer-posting.php');
		}
	}
	
	if ( ! function_exists( 'qa_action_single_answer_reply_function' ) ) {
		function qa_action_single_answer_reply_function() {
			include( QA_PLUGIN_DIR. 'templates/single-question/answer-reply.php');
		}
	}
	

	
	
	// Question action functions
	if ( ! function_exists( 'qa_action_single_question_title_function' ) ) {
		function qa_action_single_question_title_function() {
			require_once( QA_PLUGIN_DIR. 'templates/single-question/title.php');
		}
	}

if ( ! function_exists( 'qa_action_admin_actions_function' ) ) {
    function qa_action_admin_actions_function() {
        require_once( QA_PLUGIN_DIR. 'templates/single-question/admin-actions.php');
    }
}



	if ( ! function_exists( 'qa_action_single_question_view_count_function' ) ) {
		function qa_action_single_question_view_count_function() {
			require_once( QA_PLUGIN_DIR. 'templates/single-question/view-count.php');
		}
	}




	
	if ( ! function_exists( 'qa_action_single_question_meta_function' ) ) {
		function qa_action_single_question_meta_function() {
			require_once( QA_PLUGIN_DIR. 'templates/single-question/meta.php');
		}
	}


	if ( ! function_exists( 'qa_action_single_question_content_function' ) ) {
		function qa_action_single_question_content_function() {
			require_once( QA_PLUGIN_DIR. 'templates/single-question/content.php');
		}
	}
	
	if ( ! function_exists( 'qa_action_single_question_social_share_function' ) ) {
		function qa_action_single_question_social_share_function() {
			require_once( QA_PLUGIN_DIR. 'templates/single-question/social-share.php');
		}
	}
	
	if ( ! function_exists( 'qa_action_single_question_subscriber_function' ) ) {
		function qa_action_single_question_subscriber_function() {
			require_once( QA_PLUGIN_DIR. 'templates/single-question/subscriber.php');
		}
	}
	
	if ( ! function_exists( 'qa_action_single_question_sidebar_function' ) ) {
		function qa_action_single_question_sidebar_function() {
			get_sidebar();
		}
	}


add_action( 'qa_action_question_edit', 'qa_action_question_edit_title', 10 );

if ( ! function_exists( 'qa_action_question_edit_title' ) ) {
    function qa_action_question_edit_title() {
        require_once( QA_PLUGIN_DIR. 'templates/single-question/question-edit.php');
    }
}











