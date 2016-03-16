
# Muistilista

## Johdanto

Muistilista-tietokantasovelluksen käyttäjä voi tallentaa askareitaan muistiin to-do-lista tyyppisesti. Askareita voidaan lisätä ja priorisoida, jolloin ne näkyvät loogisesti tärkeysjärjestyksessä. Askareita voidaan myös jakaa eri luokkiin ja luokilla voi olla aliluokkia.

Tietokannalla on useita käyttäjiä, jotka voivat kukin kirjautua omalla käyttäjätunnuksella ja salasanalla. Jokaisella käyttäjällä on omat askareensa, tärkeysjärjestyksensa ja luokkansa. 

Tietokantasovellus pystytetään laitoksen users-palvelimelle, jossa pyöritetään PHP:lla toteutettua sovellusta käyttäen PostgreSQL-tietokantapalvelinta.

-Tomcat/Apache?
-Täytyykö käyttäjän selaimen tukea jotain tiettyä ohjelmointikieltä (esim. javascript?).
-Edellyttääkö ohjelmisto jonkun tietyn tietokannan käyttöä vai voiko sitä vaihtaa helposti? Useimmat työt toimivat vain yhdellä kannalla.

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








