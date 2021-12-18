<?php
class Baza{
    private $konekcija;

    public function __construct()
    {
        $this->konekcija = new Mysqli('mis.arbor.local', 'root', '', 'LaCasaDePapel');
        $this->konekcija->set_charset("utf-8");
    }

    public function pretraziSveEpizode($sezonaID, $sortiranje)
    {
        if($sezonaID == 0){
            $query = "SELECT * FROM epizoda e join sezona s on e.sezonaID = s.sezonaID order by brojEpizode $sortiranje";
        }else{
            $query = "SELECT * FROM epizoda e join sezona s on e.sezonaID = s.sezonaID WHERE e.sezonaID = $sezonaID order by brojEpizode $sortiranje";
        }

        $niz = [];

        $rezultatUpita = $this->konekcija->query($query);

        while($red = $rezultatUpita->fetch_object()){
            $niz[] = $red;
        }

        return $niz;
    }

    public function vratiSveSezone()
    {
        $query = "SELECT * FROM sezona";

        $niz = [];

        $rezultatUpita = $this->konekcija->query($query);

        while($red = $rezultatUpita->fetch_object()){
            $niz[] = $red;
        }

        return $niz;
    }

    public function usesiEpizodu($nazivEpizode, $brojEpizode, $sezonaID, $review, $ocena)
    {
        $query = "INSERT INTO epizoda VALUES (null, '$nazivEpizode', $sezonaID, $brojEpizode, $review, $ocena)";
        return $this->konekcija->query($query);
    }

    public function izmeni($epizodaIzmena, $ocenaIzmena)
    {
        $query = "UPDATE epizoda SET ocena=$ocenaIzmena WHERE id =$epizodaIzmena";
        return $this->konekcija->query($query);
    }

    public function obrisi($epizodaBrisanje)
    {
        $query = "DELETE FROM epizoda WHERE id =$epizodaBrisanje";
        return $this->konekcija->query($query);
    }
}