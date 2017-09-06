<?php

namespace AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * class RacesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RacesRepository extends EntityRepository
{
    /**
     * @return Query
     */
    public function getAllRaces()
    {
        //Création du queryBuilder
        $qb = $this->createQueryBuilder("races");

        //Récupération des personnages lié à la race
        $qb
            ->addSelect(
                "characters",
                "media"
                )
            ->leftJoin("races.characters", "characters")
            ->leftJoin("races.media", "media")
        ;

        //Renvoi uniquement la requete
        return $qb->getQuery();
    }

    /**
     * @param int $idRaces
     * @return Query
     */
    public function getRaceById($idRaces)
    {
        //Création du queryBuilder
        $qb = $this->createQueryBuilder("races");

        //Récupération de la race gràce à l'id
        $qb
            ->addSelect(
                "characters",
                "media"
            )
            ->leftJoin("races.characters", "characters")
            ->leftJoin("races.media", "media")
            ->where($qb->expr()->eq("races.id", ":idRaces"))
            ->setParameter("idRaces", $idRaces)
        ;
        //Retour de la requete
        return $qb->getQuery();
    }

    public function getCountEnableRace($isActivate)
    {
        $qb = $this->createQueryBuilder("races");

        $qb
            ->select("races")
            ->where($qb->expr()->eq("races.active", ":isActivate"))
            ->setParameter("isActivate", $isActivate)
        ;

        return $qb->getQuery();
    }
}
