# Property import and crud

Not gonna lie, this was an absolute mind-flood. I don't think I've worked without a framework to go from for at least 5 years, or at least I've definitely not had to build a project from scratch. I did have a look at SlimPHP, but couldn't really wrap my head around it, and the documentation for the Skeleton suggestion seemed a bit... Everywhere to say the least.

In the end I decided to roll my own, using some of the techniques I'd picked up since using Laravel for a long time and trying to keep myself organised so I can work through any issues.

## Installation

Clone it down, set up your server to point towards `public/index.php` (Valet will do this automatically);

Copy the .env.example file into .env

```cp .env.example .env```

Enter the details it asks for. `API_URL` is the URL provided in the spec sheet (Unadjusted at all. just the URL. No additions)

Run `php install` to create the DB schema, or use the `.sql` file provided in the repo.

Run `php import` to grab all the remote records from the API.

### Things that definitely don't work as you would want.

I want to say "All of it", but that feels a bit defeatist at this point.

So the validation is pretty barebones. In fact, there's not really any validation there at all. I've put some super basic HTML validation in (required on inputs), and I've sanitised the strings as they come in to the server, but that's one area where I struggled. I found a neat little tutorial that I would probably do something similar, just to provide some more robust validation than what is there.

`https://supunkavinda.blog/php/input-validation-with-php`

But kinda ran myself out of time and desire to do so.

The other major problem is that I'm limiting the results down to 100. This was because PHP kept throwing me an out of memory error, which is understandable, but I just didn't find the time to actually implement pagination on the index.

#### Things I've learned

Laravel is a massive crutch and I should probably make sure I reinforce my use of it by taking apart some of the "Magic" under the hood. I'd love to get a better grasp of how they handle DI and their IoC, my routes file is a massive mess because I couldn't be bothered to set up a proper controller system and just relied on some super basic router to try and handle it for me.
