=== Question Answer ===
	Contributors: pickplugins
	Donate link: http://pickplugins.com
	Tags:  Question Answer, Question, Answer
	Requires at least: 4.1
	Tested up to: 4.7
	Stable tag: 1.2.6
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html

	Create Awesome Question and Answer Website in a Minute

== Description ==

Built Question Answer site for your WordPress.

### Question Answer by [https://www.pickplugins.com](https://www.pickplugins.com/?ref=wordpress.org)

* [Question Answer - Bundle](https://www.pickplugins.com/product/question-answer/?ref=wordpress.org)
* [Live Demo](http://www.pickplugins.com/demo/question-answer/?ref=wordpress.org)
* [Documentation](http://pickplugins.com/docs/documentation/question-answer/?ref=wordpress.org)


<strong>Plugin Features</strong>

* schema.org support.
* Archive page via shortcode.
* Frontend question submission form via shortcode.
* Awesome account page via shortcode.
* Ton of filter & action hook to extend.

<strong>Archive page features</strong>

* Responsive archive page for questions.
* Featured question at top with highlighted background.
* Question solved marker.
* Search & filtering by user slug, category, keywords, question status.
* Search by question categories.
* Different sorting by title, comment count, latest & date.
* Display view count for questions.
* Display answers count.
* Display up vote & down vote buttons.
* Breadcrumb navigation & menu.
* Add question button at top right.
* User thumbnail.
* Pagination.

<strong>Single question page features</strong>

* Breadcrumb navigation & menu.
* Admin can change post status.
* User thumbnail, role display.
* Question category, posting date & time, total answer count display.
* Admin and quesiton poster can make the question as solved or un-solved.
* Any user can subscribe the question to gey notifications.
* Admin can marked as featured question.
* Question comments.
* Subscriber total count & list with thumbnail display.
* WP Editor for answer posting.
* Private or public answer. private answer only can display admin and question poster and answer poster.
* Answer sortings by voted, top voted & older.
* Best answer, admin & question poster can choose best answer. best answer can be remove future and choose another.
* Answer up vote & down vote.
* Answer comments. ajax based submission.
* Flag for comments to warn user.


<strong>Question submission for features</strong>

* Based on filter hook & easy to extend for add custom input fields.
* Default input fields are title, content, status, categories, tags.
* reCAPTCHA on question submission.


<strong>Add-ons</strong>

* [Question Aswer - Email](https://wordpress.org/plugins/question-answer-email/)
* [Import DW ](https://wordpress.org/plugins/question-answer-dw-import/)
* [Import Question2answer ](https://wordpress.org/plugins/question-and-answer-import-question2answer/)
* [Import AnsPress ](https://wordpress.org/plugins/question-answer-import-anspress/)
* [Related Questions ](https://wordpress.org/plugins/question-answer-related-questions/)


<strong>QA Account</strong>

`
[qa_myaccount]
`


<strong>Question submission</strong>

`
[qa_add_question]
`


<strong>Question Archive</strong>

`
[question_archive]
`




<strong>Translation</strong>

Plugin is translation ready , please find the 'en.po' for default translation file under 'languages' folder and add your own translation. you can also contribute in translation, please contact us http://www.pickplugins.com/contact/

Contributor

* Bengali - Nur Hasan
* Swedish - Mikaela Hårdstam Ulfsparre
* Chinese - Lei lyn

== Frequently Asked Questions ==

= Single question page showing 404 error , how to solve ? =

Pelase go "Settings > Permalink Settings" and save again to reset permalink.


= Single question page style broken, what should i do ? =

Please add following action on your theme functions.php file , you need to edit container based on your theme
`
add_action('qa_action_before_single_question', 'qa_action_before_single_question', 10);
add_action('qa_action_after_single_question', 'qa_action_after_single_question', 10);

function qa_action_before_single_question() {
  echo '<div id="main" class="site-main">';
}

function qa_action_after_single_question() {
  echo '</div>';
}

`




== Installation ==

1. Install as regular WordPress plugin.<br />
2. Go your plugin setting via WordPress Dashboard and find "<strong>Question Answer</strong>" activate it.<br />


== Screenshots ==

1. Screenshot 1
2. Screenshot 2
3. Screenshot 3
4. Screenshot 4
5. Screenshot 5
6. Screenshot 6
7. Screenshot 7
8. Screenshot 8
9. Screenshot 9
10. Screenshot 10



== Changelog ==

= 1.2.6 =
* 11/05/2017 add - Comment up & down vote.
* 11/05/2017 update - Notification area width.

= 1.2.5 =
* 04/05/2017 fix - Duplicate post displaying on archive page.
* 04/05/2017 add - new option Who can see quick notes (by role) ?.
* 04/05/2017 fix - Hide empty quick note text.
* 04/05/2017 add - New option Editor type for answer posting.
* 04/05/2017 add - New option Enable media upload button on editor.
* 04/05/2017 add - Flag on comments.
* 04/05/2017 add - Flag on answers.
* 04/05/2017 add - Flag on questions.

* 04/05/2017 add - new option Flag button background color.
* 04/05/2017 add - new option Vote button background color.
* 04/05/2017 add - new option Ask button background color.
* 04/05/2017 add - new option Ask button text color.
* 04/05/2017 add - best answer ribbon.
* 04/05/2017 add - Notification for question, answer, comment flag.



= 1.2.4 =
* 29/04/2017 fix - Duplicate post displaying on archive page.

= 1.2.3 =
* 29/04/2017 add - Some color option added.

= 1.2.2 =
* 25/04/2017 add - redirect to correct url after change status.

= 1.2.1 =
* 24/04/2017 add - notification bubble hide when zero.
* 24/04/2017 add - featured question at first on archive.

= 1.2.0 =
* 24/04/2017 add - search keyword.
* 24/04/2017 update - Best answer style update.
* 24/04/2017 update - Answer reply button style update.
* 24/04/2017 update - question post status submit update.


= 1.0.30 =
* 17/04/2017 add - Ask question button at breadcrumb right side.

= 1.0.29 =
* 11/03/2017 fix - Reply on answer logged-in user name.


= 1.0.27 =
* 20/02/2017 add - Latest Questions widget.

= 1.0.26 =
* 02/02/2017 fix - sidebar issue fixed.

= 1.0.25 =
* 18/01/2017 add - added Swedish translation file.
* 18/01/2017 fix - private answer reply display issue fixed.

= 1.0.24 =
* 03/01/2017 add - Custom link redirect after login via my account page.
* 03/01/2017 fix - Custom link redirect login on question submit page.

= 1.0.23 =
* 09/12/2016 fix - Submitted question status issue fixed.

= 1.0.22 =
* 22/11/2016 add - Added poll on questions.

= 1.0.21 =
* 21/11/2016 add - manage answer post by role.
* 21/11/2016 add - manage post comment on answer by role.

= 1.0.20 =
* 21/11/2016 fix - broken div issue fixed single question.

= 1.0.19 =
* 21/11/2016 add - ajax suggestion list before submit question.

= 1.0.18 =
* 21/11/2016 add - Quick Notes for answer reply.

= 1.0.17 =
* 18/11/2016 fix - choosing best answer loggedout user issue fixed.

= 1.0.16 =
* 18/11/2016 add - Question vote on archive page.

= 1.0.15 =
* 30/10/2016 update - Responsive update.

= 1.0.14 =
* 30/10/2016 fix - Only admin can make featured question.
* 30/10/2016 fix - missing closing div on single question page.
* 31/10/2016 fix - private answer display issue fixed.

= 1.0.13 =
* 20/10/2016 add - Question comment permalink added.
* 20/10/2016 add - Answers comment permalink added.
* 20/10/2016 fix - Time in notification fixed.

= 1.0.12 =
* 17/10/2016 fix - link issue fixed on answer comment text.

= 1.0.11 =
* 12/10/2016 add - Comment popup removed.
* 12/10/2016 fix - minor php issue fixed.
* 12/10/2016 add - date & time for notifications.


= 1.0.10 =
* 30/09/2016 add - Comments wpautop added.

= 1.0.9 =
* 21/09/2016 add - marked as read & unread notifications.

= 1.0.8 =
* 20/09/2016 fix - answer display issue fixed after submitted.

= 1.0.7 =
* 19/09/2016 add - question submit form filterbale.

= 1.0.6 =
* 07/09/2016 add - admin can publish, draft, pending from frontend.
* 07/09/2016 add - Best Answer background color.

= 1.0.5 =
* 06/09/2016 add - subscriber for answer.
* 06/09/2016 add - Best Answer.	
* 06/09/2016 add - Featured question.	
* 06/09/2016 add - Social share icons.
* 06/09/2016 add - comment link fixed on notification box.	
* 06/09/2016 add - answer link fixed on notification box.			

= 1.0.4 =
* 28/08/2016 add - subscriber for questions.

= 1.0.3 =
* 28/08/2016 add - addons page.

= 1.0.2 =
* 27/08/2016 add - Bangla translation.

= 1.0.1 =
* 25/08/2016 add - Notifications.

= 1.0.0 =
* 10/08/2016 Initial release.
