# easy-video

== Steps ==
As an admin, I should be able to bulk import videos from the youtube channel feed or user feed to a custom post type video
  - Estimated Time: 1 hour
  - Remaining Time: Completed
It should also allow video categories to be saved as well and correctly attached to the imported video.
  - Estimated Time: 10 minutes
  - Remaining Time: Completed
As an admin, I should be able to search and delete any individual video.
  - Estimated Time: 10 minutes
  - Remaining Time: Completed
As an admin, I should be able to bulk delete videos.
  - Estimated Time: 10 minutes
  - Remaining Time: Completed
Make the videos playable on frontend.
  - Estimated Time: 1 hour
  - Remaining Time: Completed

== Installation ==

1. In your admin panel, go to plugins and click the Add New button.
2. Click Upload Plugin and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use the plugin right away.

You should see a new admin menu in the admin panel called "Easy Video"

== Use == 
1. In order to add import new channel go to "Easy Video" Panel and click on "Import Video"
   - Provide Channel ID
   - It will automatically grab all the videos in that channel
   - Select Category for each video and even can change title of the video
2. Inside the "All Videos" page admin can see/add/delete/edit any Video
3. Categories can be handled form the "Categories" page
4. User [easy_video] shortcode to display it anywhere
   - For php templates: <?ph echo do_shortcode('[easy_video]') ?>
   - Builder Editor: [easy_video]