## Symfony 2.7 - zadanie testowe

#### Treść zadania

1. Proszę utworzyć projekt w Symfony2 w wersji 2.7 o nazwie TestProject.
2. Proszę utworzyć bundle o nazwie AdFinemSimpleFormBundle.
3. Proszę użyć ORM Doctrine2.
4. Proszę utworzyć:
 * formularz dodający osobę zawierający następujące pola,
 * imię,
 * nazwisko,
 * email,
 * załączniki.
 * Imię jest polem niewymaganym, nie może być dłuższe niż 10 znaków,
 * Nazwisko jest polem wymaganym, jeśli imię zaczyna się od litery A, to
wówczas nazwisko nie może się zaczynać od A,
 * Email, jest polem wymaganym, proszę sprawdzić, czy email jest wprowadzony
prawidłowo i czy domena istnieje oraz czy nie ma już w bazie użytkownika o
tym samym adresie email,
 * formularz musi zawierać przynajmniej jeden załącznik w postaci pliku
będącego obrazkiem, maksymalny rozmiar pojedynczego pliku 1MB,
użytkownik może dodać kolejny załącznik klikając przycisk „Add file”,
załączników może być maksymalnie 5.
5. Proszę wyświetlić listę dodanych osób, zawierającą:
 * id,
 * data dodania,
 * nazwisko,
 * Zobacz więcej,
 * Edytuj,
 * Usuń.
6. Zobacz więcej, podgląd szczegółów osoby, wraz z możliwością pobrania
poszczególnych załączników.
7. Edycja, podczas edycji nie ma możliwości dodawania, zmieniania załączników,
proszę zapisać czas edycji.
8. Usuń – usuwamy osobę wraz załącznikami.
9. Na plus, ale nie obligatoryjnie, proszę zastosować prosty layout bazujący na
Bootstrapie.
10. Proszę komentarze, nazwy zmiennych, funkcji itd. zapisywać w języku
angielskim.


#### Instalacja

Trzeba mieć w bazie danych użytkownika z loginem "root" i hasłem "NULL"

Następnie należy wydać takie komendy:

	git clone https://github.com/wojtek77/testing-task-2015-10-02.git
	cd testing-task-2015-10-02
	composer install
	php app/console doctrine:database:create
	php app/console doctrine:schema:create
