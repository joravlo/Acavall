<?php

namespace AcavallBundle\Repository;

/**
 * EventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventRepository extends \Doctrine\ORM\EntityRepository
{
  public function getEvetsByCategory($category)
  {
    return $this->createQueryBuilder('e')
    ->andWhere('e.publish = :publishEvent')
           ->innerJoin('e.categories', 'c', 'WITH', 'c.id = :idCategory')
           ->setParameter('idCategory', $category)
           ->setParameter('publishEvent', "1")->getQuery()->getResult();
  }

  public function getEvetsToday()
  {
    $todayDate = new \DateTime("now");
    $todayFormat = $todayDate->format('Y-m-d');
    $qb = $this->createQueryBuilder('e')
    ->andWhere('e.date >= :todayFirst')
            ->andWhere('e.date <= :semanaViene')
            ->andWhere('e.publish = :publishEvent')
            ->setParameter('todayFirst', $todayFormat . " 00:00:00")
            ->setParameter('semanaViene', $todayFormat . " 23:59:59")
            ->setParameter('publishEvent', "1")
            ->getQuery();

            return $qb->getResult();
  }

  public function getEvetsTomorrow()
  {
    $tomorrowDate = new \DateTime("now");
    $tomorrowDate->modify('+1 day');
    $tomorrowFormat = $tomorrowDate->format('Y-m-d');
    $qb = $this->createQueryBuilder('e')
    ->andWhere('e.date >= :todayFirst')
            ->andWhere('e.date <= :semanaViene')
            ->andWhere('e.publish = :publishEvent')
            ->setParameter('todayFirst', $tomorrowFormat . " 00:00:00")
            ->setParameter('semanaViene', $tomorrowFormat . " 23:59:59")
            ->setParameter('publishEvent', "1")
            ->getQuery();

            return $qb->getResult();
  }

  public function getEventsThisWeek()
  {
    $day = date('w');
    $week_start = date('Y-m-d', strtotime('-'.($day-1).' days'));
    $week_end = date('Y-m-d', strtotime('+'.(7-$day).' days'));

    $qb = $this->createQueryBuilder('e')
    ->andWhere('e.date >= :firstDay')
            ->andWhere('e.date <= :lastDay')
            ->andWhere('e.publish = :publishEvent')
            ->setParameter('firstDay', $week_start . " 00:00:00")
            ->setParameter('lastDay', $week_end . " 23:59:59")
            ->setParameter('publishEvent', "1")
            ->getQuery();

            return $qb->getResult();
  }

  public function getEventsThisWeekend()
  {
    $day = date('w');
    $weekend_start = date('Y-m-d', strtotime('+'.(6-$day).' days'));
    $weekend_end = date('Y-m-d', strtotime('+'.(7-$day).' days'));

    $qb = $this->createQueryBuilder('e')
    ->andWhere('e.date >= :firstDay')
            ->andWhere('e.date <= :lastDay')
            ->andWhere('e.publish = :publishEvent')
            ->setParameter('firstDay', $weekend_start . " 00:00:00")
            ->setParameter('lastDay', $weekend_end . " 23:59:59")
            ->setParameter('publishEvent', "1")
            ->getQuery();

            return $qb->getResult();
  }

  public function getEventsThisMonth()
  {
    $month_start = new \DateTime('first day of this month');
    $month_start_format = $month_start->format('Y-m-d');
    $month_end = new \DateTime('last day of this month');
    $month_end_format = $month_end->format('Y-m-d');

    $qb = $this->createQueryBuilder('e')
    ->andWhere('e.date >= :firstDay')
            ->andWhere('e.date <= :lastDay')
            ->andWhere('e.publish = :publishEvent')
            ->setParameter('firstDay', $month_start_format . " 00:00:00")
            ->setParameter('lastDay', $month_end_format . " 23:59:59")
            ->setParameter('publishEvent', "1")
            ->getQuery();

            return $qb->getResult();
  }
}
