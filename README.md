## About Project

This is a Linktree problem soultions setup based on PHP Laravel 8

## Getting Started
1. make sure your PHP version >=7.3.3
2. git clone the project
3. `cd linktree-interview-app`
4. run `php artisan serve`
5. your project should be available on your `localhost:8000`

## Problems
We have three new link types for our users.

1. Classic
	- Titles can be no longer than 144 characters.
	- Some URLs will contain query parameters, some will not.
2. Shows List
	- One show will be sold out.
	- One show is not yet on sale.
	- The rest of the shows are on sale.
3. Music Player
	- Clients will need to link off to each individual platform.
	- Clients will embed audio players from each individual platform.

## Mind Roadmap & Design

https://miro.com/app/board/uXjVODGEkPk=/?invite_link_id=50655369786

## Solutions
### Database Design
three entities introduced:
1. Link
2. LinkMusic
3. LinkShows

### Introduce two APIs to meet the reqirements
1. Create Link with three different types
    - URL: `{host}/api/v1/link/create`
    - Methord: POST
    - sample payload:
    ```
    {
        "name": "my music album",
        "url": "mymusic.com",
        "type": "music",
        "platforms": [
            {
                "name":"sample",
                "ur1l":"sample.com/sample"
            },
            {
                "name":"sample2",
                "ur1l":"sample.com/sample2"
            },
        ]
    }
    ```
2. Get All links by User Id
   - URL: `{host}/api/v1/links/byUserId/{userId}?orderBy=created_time&order=asc`
   - Methord: GET
   - sample response
   ```
   {
    "data": [
        {
            "name": "shop link"
            "url": "myshop.com/xxxx"
            "type": "classic",
            "metadata": [],
            "createdDate": "2022-01-01 12:00:00"
        },
        {
            "name": "shop link"
            "url": "myshop.com/xxxx"
            "type": "music",
            "metadata": [
                {
                    "name": "spotify"
                    "url": "open.spotify.com/xxxxx"
               },
               {
                    "name": "youtube"
                    "url": "www.youtube.com/xxxxx"
               }
               ...
            ],
           "createdDate": "2022-01-02 13:00:00"
        }
      ]
    }
   ```

## License

[LICENSE.txt](https://github.com/rob-ren/linktree-interview-app/files/8329612/LICENSE.txt)
