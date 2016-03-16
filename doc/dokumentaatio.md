
# Muistilista

## Johdanto

Muistilista-sovelluksen on tarkoitus auttaa käyttäjäänsä hallinnoimaan askareitaan ja täten myös ajankäyttöään. Käyttäjä voi tallentaa suunnitellut askareensa sovellukseen ja asettaa ne tärkeysjärjestykseen. Askareet on myös mahdollista jakaa eri luokkiin. Käyttäjä voi itse lisätä ja poistaa luokkia ja luokilla voi olla aliluokkia.

Sovelluksella voi olla useita käyttäjiä, jotka kukin kirjautuvat sovellukseen omalla käyttäjätunnuksella ja salasanalla. Jokaisella käyttäjällä on omat askareensa, luokkansa ja tärkeysjärjestyksensä. 

Tietokantasovellus toteutetaan PHP:lla ja pystytetään laitoksen users-palvelimelle Apache-palvelimen alle. Sovellusta pyöritetään käyttäen PostgreSQL-tietokantapalvelinta. Koska sovellus on tarkoitus totetuttaa PHP:llä, käyttäjän selaimen ei tarvitse tukea esimerkiksi Javascriptiä. Sovellus tehdään PostgreSQL-palvelimelle sopivaksi, jolloin sen ei pitäisi toimia muilla palvelimilla.


##Yleiskuva järjestelmästä

###Käyttötapauskaavio

###Käyttäjäryhmät

Sovelluksella on yksi käyttäjäryhmä eli muistilistan pääkäyttäjät, jotka hallinnoivat omia askareitaan sovelluksessa.

###Käyttötapauskuvaukset

Kirjautuminen:
Käyttäjä kirjautuu sovellukseen omalla käyttäjätunnuksella ja salasanalla

Askareen lisäys:
Käyttäjä lisää itselleen askareen nimen ja halutessaan kuvauksen ja priorisoinnin

Askareen muokkaus:
Käyttäjä muokkaa askareensa nimeä, kuvausta tai priorisointia tai lisää puuttuvan kuvauksen tai priorisoinnin

Askareen poisto:
Käyttäjä poistaa askareensa 

Luokkien lisäys:
Käyttäjä lisää luokkia askareita varten

Luokkien poisto:
Käyttäjä poistaa luokan (edellyttääkö että luokka on tyhjä vai poistuvatko luokan sisäiset askareet samalla)

Askareiden luokittelu:
Käyttäjä sijoittaa askareelle luokan

Luokille aliluokkia:
Käyttäjä lisää olemassa olevalle luokalle aliluokan

Luokka aliluokaksi:
Käyttäjä muokkaa olemassa olevan luokan toisen luokan aliluokaksi








