---
layout: default
sitemap: false
---
<script>
$( document ).ready(function() {
    $('.thank-you-heading').fadeIn(200).fadeOut(200).fadeIn(200).fadeOut(200).fadeIn(200).fadeOut(200).fadeIn(200).delay(6000).fadeOut(1000);
});
</script>
<div class="w-section thank-you-section">
    <div class="w-container">
        <div class="section-headings success-heading thank-you-heading">
          <h1>Thank You for Signing Up!</h1>
          <h2 class="success-subheading" style="font-weight: normal;margin-bottom: 0;">Please Confirm Your Email Address</h2>
          <p class="thank-you-p mail-confirmation" style="font-weight: bold;font-size: 14px;color: gray;margin: 0 auto;max-width: 470px;font-weight: normal;">Look for the verification email in your inbox and click the link in the email to activate your new account.</p>
        </div>
      <div class="success-account-details">
        <div class="w-row">
          <div class="w-col w-col-12">
            <div class="get-you-started-div">
              <h3 class="thank-you-h3">Let&apos;s Get You Started</h3>
              <p class="thank-you-p">To complete your registration please follow the email verification link in the welcome email you'll receive shortly.</p>
              <p class="thank-you-p">This quick guide will get you started with the basics; How to authenticate with the Kaltura API, what are Kaltura entries, and how to embed a video.
              <br />We also recommend that you visit our <a href="https://vpaas.kaltura.com/documentation/01_VPaaS-API-Getting-Started/Getting-Started-VPaaS-API.html">Get Started with Kaltura VPaaS guide</a> and share it with your team members.
              </p>
                  <ul>
                    <li><a href="#partnerid">partnerId (Kaltura Account ID)</a></li>
                    <li><a href="#ks">ks (Kaltura API Session)</a></li>
                    <li><a href="#entryid">entryId (Media Asset ID)</a></li>
                    <li><a href="#uiconfid">uiConfId (Widget Instance ID)</a></li>
                </ul>
                <h4 id="embedexample" class="thank-you-h4">Video Player Embed</h4>
                <p class="thank-you-p">The below example shows the most basic player embed. Player embed is a JavaScript code that references your <a href="#partnerid">account ID</a>, <a href="#entryid">video ID</a> and <a href="#uiconfid">player widget instance ID</a>.<br />
This quick start guide covers these basic Kaltura parameters, and gets you started with all the important Kaltura VPaaS tools for building video experiences and workflows, and integrating video natively into your own applications.<br />
The Kaltura Player is the building block by which you deliver video experiences to your users. It also collects viewer engagement analytics about who, when and how users interact with your video.</p>
                <div class="w-row">
                    <div id="embedcode" class="w-col w-col-6">
                        <div class="highlighter-rouge" style="padding-right: 10px;"><pre class="highlight" style="margin: 0;background: none;"><code><span class="c1">kWidget</span><span class="c1">.</span><span class="c1">embed</span><span class="c1">({</span>
    <span class="s1">'targetId'</span><span class="c1">:</span> <span class="s1">'kaltura_player'</span><span class="c1">,</span>
    <span class="s1">'wid'</span><span class="c1">:</span> <span class="s1">'_811441'</span><span class="c1">,</span>
    <span class="s1">'uiconf_id'</span> <span class="c1">:</span> <span class="s1">34599271</span><span class="c1">,</span>
    <span class="s1">'entry_id'</span> <span class="c1">:</span> <span class="s1">'0_4kwzg46z'</span><span class="c1">,</span>
    <span class="s1">'flashvars'</span> <span class="c1">:</span> <span class="c1">{</span>
        <span class="nx">// Add dynamic configrations here such as page-specific or user-specific configs.</span>
    <span class="c1">}</span>
<span class="c1">});</span>
</code></pre>
                        </div>
                    </div>
                    <div id="embedplayer" class="w-col w-col-6">
                        <div class="w-embed w-iframe w-script media-embed-div">
                            <!-- Outer div defines maximum space the player can take -->
                            <div style="width: 100%;display: inline-block;position: relative;">
                              <!--  inner pusher div defines aspect ratio: in this case 16:9 ~ 56.25% -->
                              <div id="dummy" style="margin-top: 56.25%;"></div>
                              <!--  the player embed target, set to take up available absolute space   -->
                              <script src="https://cdnapisec.kaltura.com/p/811441/sp/81144100/embedIframeJs/uiconf_id/35015842/partner_id/811441" style="margin: 0px 0px 0px 0px;"></script>
                              <div id="kaltura_player_1461185766" style="position:absolute;top:0;left:0;left: 0;right: 0;bottom:0;border:none;"></div>
                            </div>
                            <script>
                              kWidget.embed({
                                "targetId": "kaltura_player_1461185766",
                                "wid": "_811441",
                                "uiconf_id": 35015842,
                                "flashvars": {
                                  "streamerType": "auto"
                                },
                                "entry_id": "0_4kwzg46z"
                              });
                            </script>
                        </div>
                    </div>
              </div>
              <h4 id="partnerid" class="thank-you-h4">The Kaltura Account ID (Partner Id)</h4>
              <input type="text" value="partnerId: <?php echo $_GET['partner_id'] ? $_GET['partner_id'] : '811441'; ?>" readonly="" size="24" style="background: transparent;font-size: 12px;border: solid 1px #9EB4B7;margin-bottom: 8px;border-radius: 4px;padding: 2px;padding-left: 6px;">
              <p class="thank-you-p">The Kaltura Partner ID, or PID, is a unique number identifying your Kaltura account.<br />You will need to pass the pid paramemter everytime you authenticate with the Kaltura API, or connect with integrated apps.</p>
              
              <h4 id="ks" class="thank-you-h4">Kaltura Session</h4>
              <input type="text" value="<?php echo $_GET['ks'] ? $_GET['ks'] : 'djJ8MjEzOTQyMnxLngKd0BRQwS1EWdLV-T_Um8rRCed9mYyBwu_VOcglQ8mHlyvzAD8At9qPm2HgKoYMi5hdw3THj6ZXfAZGZyjE'; ?>" readonly="" style="background: transparent; font-size: 12px; border: solid 1px #9EB4B7; margin-bottom: 8px; border-radius: 4px; padding: 2px; width: 100%;">
              <p class="thank-you-p">The string above is a Kaltura Session (aka KS). The KS authenticates the account and user when making an API call. You are expected to provide a generated KS with every API call you will make.
              <br />
              There are three methods for generating a Kaltura Session:</p>
              <ul class="case-study-template-list-wrapper-bullets">
                <li class="thank-you-li-bullets">Calling the&nbsp;<span class="code-highlight"><a href="/api-docs/Generate_API_Sessions/session/session_start" target="_blank">session.start</a></span>&nbsp;action. This method is recommended for scripts and applications that only you will have access to.</li>
                <li class="thank-you-li-bullets">Calling&nbsp;<span class="code-highlight"><a href="/api-docs/Generate_API_Sessions/user_loginByLoginId" target="_blank">user.loginByLoginId</a></span> action. This method is recommended for managing registered users in Kaltura, and allowing users to login using email and password. When you login to the <a href="http://www.kaltura.com/index.php/kmc" target="_blank">Kaltura Management Console</a>, the KMC app calls the user.loginByLoginId action to authenticate you using your registered email and password.</li>
                <li class="thank-you-li-bullets">Using the&nbsp;<span class="code-highlight"><a href="/workflows/Generate_API_Sessions/App_Token_Authentication" target="_blank">appToken</a></span> service. This method is recommended for when you are providing access to scripts or applications that are managed by others, and provides tools to manage API tokens per application provider, revoke access to specific applications, and more.</li>
              </ul>
              <blockquote class="recipes-ref-list">
                <strong>Learn &amp; explore with Code Recipes:</strong> 
                <ul>
                  <li><a href="/workflows/Generate_API_Sessions/Authentication" target="_blank">Creating KS using session or user services.</a></li>
                  <li><a href="/workflows/Generate_API_Sessions/App_Token_Authentication" target="_blank">Managing applications access with the appTokens service.</a></li>
                </ul>
              </blockquote>
              
              <h4 class="thank-you-h4" id="entryid">Kaltura Entries</h4>
              <input type="text" size="50" value="A Kaltura Entry Id: <?php echo $_GET['entry_id'] ? $_GET['entry_id'] : '0_4kwzg46z'; ?>" readonly="" style="background: transparent; font-size: 12px; border: solid 1px #9EB4B7; margin-bottom: 8px; border-radius: 4px; padding: 2px;">
              <p class="thank-you-p">Content assets are called entries in Kaltura. An entry is a logical object representing all aspects of the media asset including its metadata, thumbnails, transcoded flavors, captions, cue-points (timed metadata), and more.</p>
              <p class="thank-you-p">In Kaltura you can manage various types of assets, including on-demand media assets (video, audio, and image files), live stream video or audio broadcasts, as well as playlists, documents and other special data files.</p>
              <p class="thank-you-p">Kaltura entries come with basic metadata fields such as title, description and tags, and you can enrich the metadata fields available for your entries by adding your own custom metadata profiles and fields. These metadata fields can then be used for smart search queries or as rules in access control, and workflows, and even as backend event triggers.</p>
              <blockquote class="recipes-ref-list">
                <strong>Learn &amp; explore with Code Recipes:</strong> 
                <ul>
                  <li><a href="/workflows/Ingest_and_Upload_Media" target="_blank">Create and upload on-demand media files.</a></li>
                  <li><a href="/workflows/Live_Stream_and_Broadcast" target="_blank">Create live broadcast and stream live from webcam.</a></li>
                  <li><a href="/workflows/Search_Discover_and_Personalize/Kaltura_Media_Library_Search" target="_blank">List and search entries.</a></li>
                  <li><a href="/workflows/Enrich_and_Organize_Metadata/Working_with_metadata" target="_blank">Work with custom metadata.</a></li>
                  <li><a href="/workflows/Engage_and_Publish/Cue_Points" target="_blank">Timed metadata using cue points.</a></li>
                  <li><a href="/workflows/Enrich_and_Organize_Metadata/Captions" target="_blank">Upload captions and run in-video search.</a></li>
                  <li><a href="/workflows/Integration_Scheduling_and_Hooks/Backend_and_Email_Notifications" target="_blank">Working with Backend and Email Notifications.</a></li>
                </ul>
              </blockquote>
              
              <h4 class="thank-you-h4" id="uiconfid">Kaltura Player &amp; uiConf</h4>
              <p class="thank-you-p">A critical piece of every video workflow is the playback and the user-experience while interacting with video.<br />
              The Kaltura Video Player library abstracts the complexities around delivery of video across devices, browsers and native apps and the user-experience with your video. It provides a cross-platform rich UI framework, easy branding and customization features and even in-video quizzes, advertizing integrations, and a robust plugins-framework to create your own unique expeirences.<br />
              <br />The player further simplifies embedding and integrating the player into pages and apps by managing your player instances and configurations in the cloud, and providing the embed code a signle parameter - the uiConf Id.</p>
              <input type="text" value="Player instance uiConf id: <?php echo $_GET['ui_conf_id'] ? $_GET['ui_conf_id'] : '34599271'; ?>" size="50" readonly="" style="background: transparent; font-size: 12px; border: solid 1px #9EB4B7; margin-bottom: 8px; border-radius: 4px; padding: 2px;">
              <p class="thank-you-p">The uiConf ID is used to reference the player instance you wish to render when embedding a video in your pages or app views.</p>
              
              <blockquote class="recipes-ref-list">
                <strong>Learn &amp; explore with Code Recipes:</strong> 
                <ul>
                  <li><a href="http://player.kaltura.com/docs/kwidget" target="_blank">JavaScript function for player embed method.</a></li>
                  <li><a href="http://player.kaltura.com/docs/autoEmbed" target="_blank">JavaScript tag player embed.</a></li>
                  <li><a href="http://player.kaltura.com/docs/responsive" target="_blank">Example reference for responsive player embed.</a></li>
                  <li><a href="http://player.kaltura.com/docs/thumb" target="_blank">JavaScript function thmbnail embed (click turns thumbnail to player).</a></li>
                  <li><a href="http://player.kaltura.com/docs/NativeCallout" target="_blank">Enables a robust web to native bridge.</a></li>
                  <li><a href="/workflows/Engage_and_Publish/Player_UI_conf" target="_blank">Working with the uiConf service.</a></li>
                </ul>
              </blockquote>

              <div id="spacer-bottom" style="width: 10px;height: 40px;"></div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<a href="#" id="back-to-top" title="Back to top">&uarr;</a>
<script>
//This script turns all heading elments into clickable anchors, and then builds an "on this page" menu.
$( document ).ready(function() {
	//turn all headings into clicable anchors:
	$('.get-you-started-div h3, .get-you-started-div h4').filter('[id]').each(function () {
	    $(this).html('<a href="#'+$(this).attr('id')+'" class="post-content" aria-hidden="true">'+$(this).text()+'</a>');
	});
	
	//back to top
	if ($('#back-to-top').length) {
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
}
});
</script>
