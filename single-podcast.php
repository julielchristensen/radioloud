<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();
?>


<style>
    button {
        margin-top: 7rem;
        border-radius: 50px;
        text-align: center;
        cursor: pointer;
        background-color: white;
        box-sizing: border-box;
        padding: 1em 3rem;
        border-color: #013B48;
        border-style: double;
        transition-duration: 0, 4s;
    }

    button:hover {
        background-color: #FFF8E4;
    }

    #episodevisning {
        display: grid;
        grid-template-columns: 1fr 1fr;
        padding-bottom: 1rem;
        grid-gap: 5px;
    }

    #episoder {
        margin-top: 2rem;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        padding-bottom: 1rem;
        grid-gap: 20px;
    }

    main#main {
        margin: 0 3.5rem;
    }

    .tekst {
        margin-top: 3rem;
    }

    .billede {
        margin-top: 3rem;
        width: 80%;
    }

    .epibillede {
        width: 60%;
        display: block;
        margin-right: auto;
        margin-left: auto;
    }

    h3 {
        font-size: 1rem;
        font-family: 'Open Sans', sans-serif;
        color: black;
    }

    p {
        font-family: 'Open Sans', sans-serif;
        font-size: 0.7rem;
        color: black;
    }

</style>

<section id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="knap">
            <button>Tilbage til podcasts</button>
        </div>

        <article id="episodevisning">
            <div>
                <img class="billede" src="" alt="">
            </div>
            <div class="tekst">
                <h3 class="navn">
                </h3>
                <p class="beskrivelse"></p>
            </div>
        </article>

        <section id="episoder">
            <template>
                <article id="episodergrid">
                    <div>
                        <img src="" class="epibillede" alt="">
                    </div>
                    <div>
                        <h3 class="epinavn">
                        </h3>
                        <p class="epibeskrivelse"></p>
                        <a href="">læs mere</a>
                    </div>
                </article>
            </template>
        </section>

    </main>

    <script>
        let podcast;
        let episoder;
        let aktuelpodcast = <?php echo get_the_ID() ?>;

        const dbUrl = "https://julielykkechristensen.dk/radioloud/wp-json/wp/v2/podcast/" + aktuelpodcast;
        const episodeUrl = "https://julielykkechristensen.dk/radioloud/wp-json/wp/v2/episode?per_page=100";

        const container = document.querySelector("#episoder");

        async function getJson() {
            const data = await fetch(dbUrl);
            podcast = await data.json();

            const data2 = await fetch(episodeUrl);
            episoder = await data2.json();
            console.log("episoder: ", episoder);

            visPodcast();
            visEpisoder();
        }

        function visPodcast() {
            console.log("hej med dig", podcast);
            document.querySelector(".navn").textContent = podcast.title.rendered;
            document.querySelector(".billede").src = podcast.billede.guid;
            document.querySelector(".beskrivelse").textContent = podcast.beskrivelse;
            document.querySelector("button").addEventListener("click", tilbageTilPodcasts);
        }

        function visEpisoder() {
            console.log("visEpisoder");
            let temp = document.querySelector("template");
            episoder.forEach(episode => {
                console.log("loop id :", aktuelpodcast);
                console.log("episode :", episode);
                if (episode.horer_til_podcast == aktuelpodcast) {
                    console.log("loop kører id :", aktuelpodcast);
                    let klon = temp.cloneNode(true).content;
                    klon.querySelector(".epinavn").innerHTML = episode.title.rendered;
                    klon.querySelector(".epibeskrivelse").innerHTML = episode.beskrivelse;
                    klon.querySelector(".epibillede").src = episode.billede.guid;
                    klon.querySelector("article").addEventListener("click", () => {})
                    klon.querySelector("a").href = episode.link;
                    container.appendChild(klon);
                }
            })
        }

        function tilbageTilPodcasts() {
            //history = webapi for at komme baglængs, hvis vi kalder back kommer vi et hak tilbage i browserhistorien (dermed tilbage til 01-kald.html)
            history.back();

        }

        getJson();

    </script>

</section>

<?php
get_footer();
