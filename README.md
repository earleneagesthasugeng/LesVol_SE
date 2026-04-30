# LesVol SE Updates

* Ban User - `participants.blade.php` fully rewritten to render real volunteer data with a Ban/Unban toggle button per participant. Backend `toggleBan()` method flips the `is_banned` flag.
* Disable Deletion - The Delete button in `options.blade.php` is now disabled (grayed out, unclickable) with a tooltip when `$volunteersCount > 0`. The backend `deleteActivity()` also double-checks and refuses.
* Submit Proof - New `submitProof()` controller method handles image upload to `storage/proofs/`. The `see-details-done.blade.php` view was fully rewritten with a working upload modal, file preview, and shows the submitted proof image.
* Transition to Done - New `markDone()` controller method sets `activity.status = 'done'`. A green "Mark as Done" button was added to `options.blade.php`. `done-activity.blade.php` was fully rewritten to render real completed activities from the database.
* Portfolio Display - `my-portfolio.blade.php` was fully rewritten to fetch and render the user's completed activities (where proof was submitted and activity status is 'done').
