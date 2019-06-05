<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use GuzzleHttp\Client;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{

    /** @var Client */
    protected $jenkinsClient;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->jenkinsClient = new Client([
            'base_uri' => 'http://localhost:8080',
            'auth'     => ['exampleUser', 'examplePass'],
        ]);
    }

    /**
     * @Given I trigger the :jobName Jenkins build with the token :token
     */
    public function iTriggerTheJenkinsBuildWithTheToken($jobName, $token)
    {
        $this->jenkinsClient->post("/job/$jobName/build?token=$token");
    }

    /**
     * @Given I retrieve the console output for the last :jobName Jenkins build
     */
    public function iRetrieveTheConsoleOutputForTheLastJenkinsBuild($jobName)
    {
        $response = $this->jenkinsClient->get("/job/$jobName/lastBuild/consoleText");
        var_dump($response->getBody()->getContents());
    }
}
