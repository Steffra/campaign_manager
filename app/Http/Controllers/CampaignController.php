<?php

namespace App\Http\Controllers;

Use App\Models\Campaign;
use Exception;
Use App\Util;



class CampaignController extends Controller
{
    public function index()
    {
        return Campaign::all();
    }

    public function show(Campaign $campaign)
    {
        return $campaign;
    }

    public function activate( Campaign $campaign)
    {
        try{
            $this->validateActivation($campaign);
            $campaign->activate();
            return response()->json($campaign, 200);
        }catch(Exception $e){
            return response()->json(['Error:' => $e->getMessage()], 400);
        }

    }

    public function inactivate( Campaign $campaign)
    {
        try{
            $this->validateInactivation($campaign);
            $campaign->inactivate();
        return response()->json($campaign, 200);
        }catch(Exception $e){
            return response()->json(['Error:' => $e->getMessage()], 400);
        }
    }

    public function approve(Campaign $campaign)
    {
        try{
            $this->validateApproval($campaign);
            $campaign->approve();
            return response()->json($campaign, 200);
        }catch(Exception $e){
            return response()->json(['Error:' => $e->getMessage()], 400);
        }
    }

    public function disapprove(Campaign $campaign)
    {
        try{
            $this->validateDisapproval($campaign);
            $campaign->disapprove();
            return response()->json($campaign, 200);
        }catch(Exception $e){
            return response()->json(['Error:' => $e->getMessage()], 400);
        }
    }

    private function validateActivation(Campaign $campaign)
    {
        if($campaign->is_active){
            throw new Exception("Can not activate an already active campaign!");
        }

        if(!$campaign->approved){
            throw new Exception("A campaign must be approved, before it can be activated!");
        }

        try{
            $this->validateOverlappingCampaigns($campaign);
        }catch(Exception $e){
            throw $e;
        }

    }

    //Throws an exception when the given campaign contains a product that's already in a running campaign
    private function validateOverlappingCampaigns(Campaign $campaign){
        $conflictingCampaigns = [];
        foreach ($campaign->products as $product){
            $runningCampaignsWithThisProduct = $product->campaigns->where('is_active', true)->where('id', '<>', $campaign->id);

            foreach ($runningCampaignsWithThisProduct as $runningCampaign){
                if(Util::isOverlappingCampaigns($campaign, $runningCampaign)){
                    $conflictingCampaigns[] = ['campaign' => $runningCampaign->name, 'product' => $product->name];
                }
            }
        }

        $campaign->unsetRelation('products');

        if(!empty($conflictingCampaigns)){
            $strErrorMessage = "Couldn't activate the campaign, because the following products are already in another running campaign:" . PHP_EOL;
            foreach($conflictingCampaigns as $conflictingCampaign){
                $strErrorMessage .= $conflictingCampaign['product'] . '(' . $conflictingCampaign['campaign'] . ')' . PHP_EOL;
            }
            throw new Exception($strErrorMessage);
        }
    }

    private function validateInactivation(Campaign $campaign)
    {
        if(!$campaign->is_active){
            throw new Exception("Can not inactivate an already inactivate campaign!");
        }
    }

    private function validateApproval(Campaign $campaign)
    {
        if($campaign->approved){
            throw new Exception("This campaign is already approved!");
        }
    }

    private function validateDisapproval(Campaign $campaign)
    {
        if(!$campaign->approved){
            throw new Exception("This campaign has not been approved yet!");
        }
    }




}
