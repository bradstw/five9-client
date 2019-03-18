<?php
namespace Bradstw\Five9\Methods;

use Bradstw\Five9\Five9Client;

class Report
{
    /**
     * API Client Connection
     * @var
     */
    protected $client;
    
    /**
     * Five9 API credentials
     * @var array
     */
    protected $credentials;
    
    /**
     * Constructor
     * @param array $credentials is an array containing values for login & password
     */
    public function __construct($credentials)
    {
        $connect = new Five9Client($credentials);
        $this->client = $connect->getClient();
    }
    
    /**
     * Run Report combines runReport, isReportRunning, getReportResult methods into one simple function
     * @param array $folder, $report, criteria(array with minimum of start and end times)
     *
     * @return array report headers and data
     */
    public function runReport($folder, $report, $criteria)
    {
        try {
            $run = $this->client->runReport([
                'folderName' => $folder,
                'reportName' => $report,
                'criteria' => $criteria
                ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        $id = $run->return;
        do {
            # Check to see if report is running and wait till it is done
            sleep(2);
            try {
                $return = $this->client->isReportRunning([
                    'identifier' => $id,
                    'timeout' => 1
                    ]);
                $running = !!($return->return);
            } catch (Exception $e) {
                $running = false;
            }
        } while ($running);
        try {
            $report = $this->client->getReportResult([
                'identifier' => $id
                ]);
        } catch (Exception $e) {
            return false;
        }
        # Build readable array to return
        $return = [];
        $headers = $report->return->header->values->data;
        if (isset($report->return->records)) {
            foreach ($report->return->records as $record_id => $record) {
                $row = $record->values->data;
                $returnRow = [];
                foreach ($row as $colId => $val) {
                    $returnRow[$headers[$colId]] = $val;
                }
                $return[] = $returnRow;
            }
        }
        return $return;
    }
}
