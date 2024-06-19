---
title: "Julia Evans, une sorcière de l’informatique qui partage ses sorts"
description: "Julie Evans est une informaticienne qui a un grand talent pour la vulgarisation de principes techniques sous forme de dessins et Solène nous présente son travail."
date: 2024-06-19
authors: [ "Solène Garda-Krebs" ]
category: "Tech féministe"
edition: "Juin 2024"
tags: ["féminisme", "tech", "pédagogie"]
---

Julia Evans est une informaticienne qui habite à Montréal. Elle aime comprendre comment fonctionnent les outils informatiques qu’elle utilise, puis transmettre ce qu’elle a appris (en anglais, mais certaines ressources sont aussi en français).

J’ai découvert son travail à travers ses [Wizard Zines](https://wizardzines.com/) : des livrets qu’elle dessine elle-même avec des bonhommes bâtons, et où elle explique, en détail et de façon très pédagogique, ce qu’elle a appris sur un sujet.

Au fur et à mesure des années, elle a abordé plein de thèmes différents. Quelques exemples, avec des extraits :

## [Le protocole HTTP](https://wizardzines.com/zines/http/) 

![CORS (cross-origin resource sharing). Cross-origin requests are not allowed by default (because of the same origin policy!) Javascript from clothes.com: POST request to api.clothes.com? Firefox: NOPE. api.clothes.com is a different origin from clothes.com If you run api.clothes.com, you can allow clothes.com to make requests to it using the Access-Control-Allow-Origin header. Here's what happens: Javascript on clothes.com: POST /buy_things Host api.clothes.com Browser (thinking to itself): That's cross-origin. I'm going to need to ask api.clothes.com if this request is allowed. Browser: OPTIONS /buy_things Host api.clothes.com "hey, what requests are allowed?" preflight request api.clothes.com: 204 No Content Access-Control-Allow-Origin: clothes.com Browser (thinking to itself): cool, the request is allowed! Browser: POST /buy_things Host: api.clothes.com Referer: clothes.com/checkout api.clothes.com: 200 OK {"thing_bought": true} This OPTIONS request is called a "preflight" request, and it only happens for some requests, like we described in the diagram on the same-origin policy page. Most GET requests will just be sent by the browser without a preflight request first, but POST requests that send a JSON need a preflight.](/img/posts/2024-06-19-julia-evans/cors.png)

Source : <https://wizardzines.com/zines/http/samples/cors_hu9073d4133fad88afb219c8ece1da3118_523331_800x0_resize_box_2.png>

## [Les DNS](https://wizardzines.com/zines/dns/)

![the DNS hierarchy. Panel 1: there are 3 levels of authoritative DNS servers. root: I'm in charge of EVERYTHING. .com nameserver: I'm in charge of all domains ending in .com . example.com nameserver: I'm in charge of example.com and its subdomains. Panel 2: the root nameserver delegates. user: what's the IP for example.com? root: I am not concerned with petty details like that Here's the address of the .com nameserver. Panel 3: the .com nameserver also delegates. user: what's the IP for example.com? .com nameserver: I am not concerned with petty details like that either. Here's the address of the example.com nameserver. Panel 4: the example.com nameserver actually answers your questions. user: what's the IP for example.com? example.com nameserver: 93.184.216.34! Panel 5: this design lets DNS be decentralized. example: for my domain jvns.ca . root (ICAN controls this!) delegates to .ca nameserver (Canada controls this!), who delegates to jvns.ca nameserver (I control this!)](/img/posts/2024-06-19-julia-evans/dns.png)

Source : <https://wizardzines.com/zines/dns/samples/1-dns-hierarchy_huc53c33f23624dd913ff0e2e141601ca5_478996_800x0_resize_box_2.png>

## [Linux ](https://wizardzines.com/zines/bite-size-linux/) 

![pipes. Panel 1: Sometimes you want to send the output of one process to the input of another "$ ls | wc -l" "53" it means 53 files! Panel 2: a pipe is a pair of 2 magical file descriptors: in and out. schema: stdin is given to ls. ls writes its result to the in file of the pipe. the out file of the pipe is given to wc. wc writes to stdout. Panel 3: when ls does write(in, "hi"), wc can read it! read(out) → "hi" Pipes are one way. You can't write to out. Panel 4: Linux creates a buffer for each pipe. schema: ls writes in it. between in and out is a block named buffer, with written it it "data waiting to be read". wc read from out. If data gets written to the pipe faster that it's read, the buffer will fill up. When the buffer it full, writes to in will block (wait) until the reader reads. This is normal and ok. Panel 5: What if your target process dies? If wc dies, the pipe will close and ls will send SIGPIPE. By default SIGPIPE terminates your process. Panel 6: named pipes. "$ mkfifo my-pipe" This lets 2 unrelated processes communicates through a pipe! process 1: "f = open(./my-pipe)" "f.write("hi!\n)" process 2: "f = open(./my_pipe)" f.readline() ← "hi!"](/img/posts/2024-06-19-julia-evans/linux.jpeg)

Source : <https://wizardzines.com/zines/bite-size-linux/samples/pipes_hua8a25628f0d1d0f465a0fa91b1228560_185482_800x0_resize_q75_box.jpg>

## [Un guide avec plein de stratégies pour débugger](https://wizardzines.com/zines/debugging-guide/)

![a debugging manifesto. 1) inspect, don't squash. bad: try to fix the bug. good: understand what happened. 2) being stuck is temporary. dev thinking: I WILL NEVER FIGURE THIS OUT! … 2 minutes later… dev thinking: wait, I haven't tried X… 3) trust nobody and nothing. dev thinking: this library can't be buggy… or CAN IT??? (pointing to the dev) slowly growing horror. 4) it's probably your code. dev thinking: I KNOW my code is right … 2 hours later… dev thinking: ugh, my code WAS the problem? 5) don't go it alone. dev 1: WHAT IS HAPPENING? dev 2: what if we try X? 6) there's always a reason. computers are always logical, even when it doesn't feel that way.7) build your toolkit. dev thinking: wow, the CSS inspector makes debugging SO MUCH EASIER. 8) it can be an adventure. dev: you wouldn't BELIEVE the weird bug I found… bug: hi!](/img/posts/2024-06-19-julia-evans/debug.png)

Source : <https://jvns.ca/images/manifesto.png> 

Le reste des sujets qu’elle a traités est à découvrir sur son site. Ses premiers zines (ceux en noir et blanc) sont gratuits. Pour les autres, on trouve la table des matières et une ou deux planches extraites pour avoir un aperçu.

J’aime beaucoup ses zines parce qu’ils sont agréables à regarder (ça compte !), très clairs et pédagogiques, mais jamais simplistes. Le but de Julia Evans est de montrer qu’un sujet qui a l’air compliqué et effrayant ne l’est en fait pas tant que ça, voire pas du tout.

Ensuite, j’ai découvert son blog, sur lequel elle raconte les sujets qui l’intéressent, les recherches qu’elle fait dessus et ce qu’elle en apprend, les questions qu’elle pose sur les réseaux sociaux et les réponses qu’on lui fait. Ses articles sont organisés par thème, ce qui permet de naviguer facilement vers le sujet qui nous intéresse.

À la lecture, on sent encore plus comment Julia Evans travaille. Elle s’interroge sur un sujet, l’explore, et partage son processus de recherche. Elle n’adopte pas la posture de la « personne qui sait ». Elle est juste curieuse et enthousiaste de partager ses découvertes. 

Enfin, elle crée à l’occasion de petits sites ou outils.

Celui dont je parle à tout le monde, c’est [Oh Shit, Git !?!](https://wizardzines.com/zines/oh-shit-git/), sorti en même temps que le zine du même nom. L’idée de base est simple : quand on rencontre un problème avec Git et qu’on ne sait pas comment le résoudre, la documentation n’aide pas beaucoup : il faudrait déjà connaitre la commande à utiliser. Ce site propose une liste de problèmes courants et la solution qui va avec. Il est disponible [en anglais](https://ohshitgit.com/), en [français](https://ohshitgit.com/fr) et dans tout un tas d’autres langues.

Dans les outils, je citerai rapidement le site [mess with dns](https://messwithdns.net/), qui permet de bidouiller des DNS sans danger pour mieux comprendre comment ça marche.

Si cette présentation vous a intéressé·e, il ne vous reste plus qu’à cliquer sur un (ou plusieurs) des liens que j’ai mis dans cet article et découvrir son travail par vous-même !
