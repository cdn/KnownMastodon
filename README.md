 # KnownMastodon

Syndicate your posts to Mastodon instances

- Share Status, Articles, Images & Bookmarks
- Handles content warnings : use || as separator between spoiler text and status. Text will be split there.
- A photo with #nsfw in title will set to sensitive and one has to click to see it in Mastodon.

Admin page shows all Mastodon servers connected by the users.

- Multiple servers possible; something breaks at three (but who needs that much syndication?)
- Selective deletion of Mastodon accounts.
- Delete instance from server page.

Still on the Todo list:

- Localisation other than English, French

Installation: 

* Save and rename KnownMastodon to IdnoPlugins/Mastodon

* You need to run ``composer install`` or ``composer update`` if you're updating in the Mastodon folder so PHP Composer will download and install the dependencies. (see "Vendor" folder)

Activate under Site Configurations—Plugins

Add an account under Account Settings–Mastodon

Credits: KnownMastodon is using the Mastodon class from https://github.com/TheCodingCompany/MastodonOAuthPHP
