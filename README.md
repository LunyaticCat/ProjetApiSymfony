Ceci est le ReadMe contenant des informations sur le projet afin de faciliter son évaluation.


Liens des projets déployé
-
  - BackEnd (API) : https://webinfo.iutmontp.univ-montp2.fr/~campsa/ProjetApiSymfony/public/api
  - My Avatar     : https://webinfo.iutmontp.univ-montp2.fr/~pujadej/ProjetWebSymphonyMyAvatar/public/index
  - FrontEnd      : https://webinfo.iutmontp.univ-montp2.fr/~depeyreg/ProjetFrontSymfony/

Liens des projets GitHub
-
  - BackEnd (API) : https://github.com/LunyaticCat/ProjetApiSymfony
  - My Avatar     : https://github.com/LunyaticCat/ProjetWebSymphonyMyAvatar
  - FrontEnd      : https://github.com/LunyaticCat/ProjetFrontSymfony

Présentation du thème choisi
-
Le thème que nous avons choisi étais Terraria.
Le jeu Terraria propose des complexités intéréssante tu fait que des stacks d'items sont requis pour pouvoir conçevoir un objet, et qu'un même objet peux être conçu de plusieurs manière
en fonction de si le monde et "Tainted" ou "Corrupted" et peuvent ainsi amener à un objet similaire pouvant être crée avec des composants différent, dans des tables différentes, ce qui mal
amené pourrai conduire à une explosion exponnentiel du nombre de craft stocké en base de donnée pour un seul objet.

Présentation de l'API
-
(expliquer le système mis en place pour la bd et quels chemin utiliser)
L'API repose sur une conceptialisation de la base de donnée dans la quel un craft d'item correspond en fait à un item_group definissent si l'objet est un item permettant le craft (table de craft) ou un composant quelconque.
ensuite un group_fragment viens lier chaque item à leurs groupes et leurs attribut le nombre requis pour le craft. enfin le craft lie l'utilisateur qui a créer un craft à ce dernier et l'item qui lui est associé.
on peux faire ces manipulations dans l'ordre avec les liens suivants :
```
1)   https://webinfo.iutmontp.univ-montp2.fr/~bruny/ApiProjet/public/api/users
1.5) https://webinfo.iutmontp.univ-montp2.fr/~bruny/ApiProjet/public/api/categories (optionel)
2)   https://webinfo.iutmontp.univ-montp2.fr/~bruny/ApiProjet/public/api/items
3)   https://webinfo.iutmontp.univ-montp2.fr/~bruny/ApiProjet/public/api/crafts
4)   https://webinfo.iutmontp.univ-montp2.fr/~bruny/ApiProjet/public/api/item_groups
5)   https://webinfo.iutmontp.univ-montp2.fr/~bruny/ApiProjet/public/api/group_fragments
```

Présentation du Front
-
La majeur partie du front se compose de requetes à l'api avec une interface. Le code pour l'affichage une famille d'items (ItemTree.vue) présente un interet particulier, il s'agit d'afficher de manière récursive un arbre de construction d'objet. Les fonctions qui gèrent les appels à l'api sont rassembler dans des classes dans les composents du projet. La connection avec Grafana se fait par un hash d'email grace au plugin md5.


Présentation de MyAvatar
-
MyAvatar est un service permettant la gestion des photos de profil des utilisateurs de notre application.

Pour récupérer la photo de profil liée à un compte, il suffit d'utiliser la route qui suit :

``/avatar/{hashMD5Email}``

Par exemple, cette route :

``https://webinfo.iutmontp.univ-montp2.fr/~pujadej/ProjetWebSymphonyMyAvatar/public/avatar/d2da44a8f89b8f0485602e27b28a94ab``

Si le paramètre de la route est mauvais, ou que l'utilisateur n'existe pas, une photo de profil par défaut (anonyme.jpg) sera renvoyée.

Récapitulatif de l'investissement
-
- Gatien c'est consacré au front et a permis l'ajout de ces fonctionnalités ainsi qu'à créer une installateur pour que chaque membre puisse l'installer localement sans difficulté. A aussi tenté infrucueusement de s'occuper de la gestion du projet. Organisation des réunions et suivi du github Project. 
- Gatien et Yann on pu conçevoir la structure de la base de donnée.
- Yann a pu assister sur le refactoring du code du front et revoir sa charte graphique CSS, mettre en place la base de donnée conceptualisé sur l'API, et commencer le système de mot de passe de l'API puis à contribué au débugage de ce dernier.
  Il a également étais responsable de préparer le rendu des projets et a fait l'intégration du projet MyAvatar au projet Front.
- Joffrey c'est consacré à la mise en place du projet MyAvatar et a ajouté la fonctionnalité de création et de lecture des images de profils sur ce dernier.
- Alexis a pu finir le système de mot de passe de l'API.

Identifiants de compte (il faut récupérer le code d'alexis puis ajouter les mot de passes à cette partie)
-
(Admin)<br>
  username : ``test``<br>
  password : ``1Bze@``<br>
(User)<br>
  username : ``testa``<br>
  password : ``1Bze@``<br>

Indications supplémentaire
-
Vous pourrez trouver un fichier install.sh pour le projet Vue.js (Front) permettant de facilement ajouter les fichiers requis afin de facilement faire tourner le site en local
