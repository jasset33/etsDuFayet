

namespace AppBundle\Repository;

use AppBundle\Entity\Proportion;
use AppBundle\Entity\WineCastle;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * ProportionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProportionRepository extends \Doctrine\ORM\EntityRepository
{
                            /*column:sql
                            champ:entity*/

    /**
     * @param $wineCastleId
     * @return array
     *
     * Retourne le nombre $limit de Reviews, les plus récentes, ayant une note suppérieur à $minMark
     */
    public function ProportionWineIdSearch($wineCastleId)
    {
        $queryBuilder = $this->createQueryBuilder('proportion');

        $queryBuilder
            // On join l'entity WineCastle à notre requête
            ->Join('proportion.wineCastleId', 'p.wineCastleId')
            ->leftJoin('proportion.encepagement1', 'p.e1')
            ->leftJoin('proportion.encepagement2', 'p.e2')
            ->leftJoin('proportion.encepagement3', 'p.e3')
            ->leftJoin('proportion.encepagement4', 'p.e4')
            // là ou l'id de WineCastle correspond à notre paramètre
            ->where('p.wineCastleId = :wineCastleId')
            ->setParameter('wineCastleId', $wineCastleId);
        return $proportion = $queryBuilder->getQuery()->getArrayResult();

    var_dump($proportion);die;
    }

}