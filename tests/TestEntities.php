<?php
use Punction\Entities\Patient;
use Hospitalplugin\DB\DoctrineBootstrap;
use Punction\Entities\PatientZZ;
use Punction\Entities\PatientPED;
use Punction\Entities\PatientBuilder;
use Hospitalplugin\utils\PersonGenerator;
use Punction\Entities\PatientDIA;

class TestEntities extends PHPUnit_Framework_TestCase
{

    /**
	 *
	 * @var $db DoctrineBootstrap
	 */
    public $entityManager;

    function setUp()
    {
        $this->entityManager = DoctrineBootstrap::getEntityManager();
        if (! $this->entityManager->isOpen()) {
            $this->entityManager = $this->entityManager->create($this->entityManager->getConnection(), $this->entityManager->getConfiguration());
        }
    }

    function testGetSetZZ()
    {
        $p = new PatientZZ(0);
        $p->setName("Jan");
        $p->setPesel("83051703671");
        $p->setNumerHistorii("123");
        $p->setAktywnoscFizyczna(1);
        $this->assertTrue($p->getName() == "Jan");
        $this->assertFalse($p->getName() == "83030301144");
        $this->assertTrue($p->getAktywnoscFizyczna() == 1);
        // test JSON
        $json = json_decode($p->toDatatablesJSONString());
        $this->assertTrue($json->aktywnoscFizyczna == 1);
        // csv string
        $this->assertTrue($p->toDatatablesString() == "Jan,83051703671,123,,0,1","db string check, expected:".$p->toDatatablesString());
        // string
        $this->assertEquals($p->toString(), "Jan83051703671id:oid:d:", "spodziewany: " . $p->toString());
    }
    
    
    function testGetSetDIA()
    {
    	$p = new PatientDIA(0);
    	$p->setName("Jan");
    	$p->setPesel("83051703671");
    	$p->setNumerHistorii("123");
    	$p->setAktywnoscFizyczna(1);
    	$p->setEdukacjaZdrowotnaIOpiekaPsychospoleczna(1);
    	$this->assertTrue($p->getName() == "Jan","check name");
    	$this->assertFalse($p->getName() == "83030301144","check pesel");
    	$this->assertTrue($p->getAktywnoscFizyczna() == 1,"check AF");
    	$this->assertTrue($p->getEdukacjaZdrowotnaIOpiekaPsychospoleczna() == 1,"check EZIOP");
    	// test JSON
    	$json = json_decode($p->toDatatablesJSONString());
    	$this->assertTrue($json->aktywnoscFizyczna == 1,"json AF");
    	// csv string
    	$this->assertTrue($p->toDatatablesString() == "Jan,83051703671,123,,0,1,,,,,,1","db string check, expected:".$p->toDatatablesString());
    	// string
    	$this->assertEquals($p->toString(), "Jan83051703671id:oid:d:", "spodziewany: " . $p->toString());
    }
    
    
    
    function testGetSetPED()
    {
        $p = new PatientPED(0);
        $p->setName("Janek");
        $p->setPesel("00230301144");
        $p->setNumerHistorii("123");
        $p->setAktywnoscFizyczna(1);
        $this->assertTrue($p->getName() == "Janek");
        $this->assertFalse($p->getName() == "00230301144");
        $this->assertTrue($p->getAktywnoscFizyczna() == 1);
        // test JSON
        // $json = json_decode($p->toDatatablesJSONString());
        // $this->assertTrue($json->aktywnoscFizyczna == 1);
        // csv string
        // $this->assertTrue($p->toDatatablesString() == "Jan,83051703671,123,,,1");
        // string
        $this->assertEquals($p->toString(), "Janek00230301144id:oid:d:");
    }

    function testPatientBuilder()
    {
        // having
        $builder = new PatientBuilder();
        $p = new PatientZZ(0);
        $p->setName("Jan");
        $p->setPesel("83051703671");
        $p->setNumerHistorii("123");
        $p->setAktywnoscFizyczna(1);
        $p->setDataKategoryzacji(new \DateTime());
        $json = json_decode($p->toDatatablesJSONString());
        $patient = new PatientZZ(0);
        $builder->map($patient, $json);
        $this->assertTrue($patient->getAktywnoscFizyczna() == 1);
    }

    function testPEDPatientBuilder()
    {
        // having
        $builder = new PatientBuilder();
        $p = new PatientPED(0);
        $p->setName("Janek");
        $p->setPesel("01251703671");
        $p->setNumerHistorii("321");
        $p->setAktywnoscFizyczna(1);
        $p->setEdukacjaZdrowotnaOrazWsparcieDzieckaIRodzicow(2);
        $p->setDataKategoryzacji(new \DateTime());
        // convert
        $json = json_decode($p->toDatatablesJSONString());
        $patient = new PatientPED(0);
        $builder->map($patient, $json);
        // assert
        $this->assertTrue($patient->getAktywnoscFizyczna() == 1);
        $this->assertTrue($patient->getEdukacjaZdrowotnaOrazWsparcieDzieckaIRodzicow() == 2);
        $this->assertTrue($patient->getHigiena() == 0);
    }

    function testStaticFunctions()
    {
        $this->assertTrue(in_array("aktywnoscFizyczna", PatientZZ::getFields()));
    }

    function testDBSaveContraint()
    {
        $p = TestEntities::getRandomPatient();
        $this->entityManager->persist($p);
        $msg = "";
        try {
            $this->entityManager->flush();
        } catch (Exception $e) {
            $msg = 'Caught exception: ' . $e->getMessage() . "\n";
        }
        $this->assertTrue(strpos($msg, "cannot be null") !== FALSE);
    }

    function testDBSave()
    {
        $patient = TestEntities::getRandomPatient();
        $patient->setDataKategoryzacji(new \DateTime("now"));
        $patient->setOddzialId(1);
        $patient->setKategoriaPacjenta(1);
        $patient->setNumerHistorii("123");
        $this->entityManager->persist($patient);
        $this->entityManager->flush();
        $this->assertTrue($patient->getId() > 0);
    }

    function testDBLoad()
    {
        $patient = new Patient(0);
        $dql = "SELECT p FROM Punction\Entities\Patient p WHERE p.name like '%'";
        $query = $this->entityManager->createQuery($dql);
        $query->setMaxResults(1);
        $patients = $query->getResult();
        $i = 0;
        foreach ($patients as $patient) {
            $i ++;
            $this->assertTrue($patient->getId() > 0);
            $this->assertTrue(strlen($patient->getName()) > 0);
        }
        $this->assertTrue($i == 1);
    }

    function testDBLoad2()
    {
        $patient = new Patient(0);
        $patient = $this->entityManager->getRepository('Punction\Entities\Patient')->findOneBy(array(
            'numerHistorii' => "123"
        ));
        $this->assertTrue($patient->getId() > 0);
        $this->assertTrue(strlen($patient->getName()) > 0);
    }

    function testDBLoad3()
    {
        $patient = new Patient(0);
        $patients = $this->entityManager->getRepository('Punction\Entities\Patient')->findBy(array(
            'numerHistorii' => "123"
        ));
        $i = 0;
        $prev_id = - 1;
        foreach ($patients as $patient) {
            $i ++;
            $this->assertTrue($patient->getId() > 0);
            $this->assertTrue(strlen($patient->getName()) > 0);
            $this->assertTrue($prev_id != $patient->getId());
            $prev_id = $patient->getId();
            if ($i >= 3) {
                break;
            }
        }
        $this->assertTrue($i > 0);
        $this->assertTrue($i < 4);
    }

    function testDBLoad4()
    {
        $qb = $this->entityManager->createQueryBuilder();
        $q = $qb->select('p') ->
	/* */ from('Punction\Entities\Patient', 'p')->
	/* */ where('p.kategoriaPacjenta = ?1')->
	/* */ setParameter(1, '1')->
	/* */ orderBy('p.name')->
	/* */ setFirstResult(0)->
	/* */ setMaxResults(3)
            ->getQuery();
        $patients = $q->getResult();
        $i = 0;
        $prev_id = - 1;
        foreach ($patients as $patient) {
            $i ++;
            $this->assertTrue($patient->getId() > 0);
            $this->assertTrue(strlen($patient->getName()) > 0);
            $this->assertTrue($prev_id != $patient->getId());
            $prev_id = $patient->getId();
        }
        $this->assertTrue($i > 0);
        $this->assertTrue($i < 4);
    }
    
    private function getRandomPatient() {
        $person = PersonGenerator::getRandomPerson();
        $name = explode('|',$person)[0];
        $pesel = explode('|',$person)[1];
        $pb = new PatientBuilder();
        return $pb->name($name)->pesel($pesel)->build();
    }
}

