<?php
include_once( 'extension/groupdocsviewer/classes/groupdocsviewer.php' );

/** 
 * Operator: gvd('list') and gvd('count') <br> 
 * Count: {gvd('count')} <br> 
 * Liste: {gvd('list')|attribute(show)} 
 */ 
class GVDOperator
{ 
    public $Operators;
 
    public function __construct( $name = 'gvd' )
    { 
        $this->Operators = array( $name ); 
    }
 
    /** 
     * Returns the template operators.
     * @return array
     */ 
    function operatorList()
    { 
        return $this->Operators; 
    }
 
    /**
     * Returns true to tell the template engine that the parameter list 
     * exists per operator type. 
     */ 
    public function namedParameterPerOperator() 
    { 
        return true; 
    }
 
    /**
     * @see eZTemplateOperator::namedParameterList 
     **/ 
    public function namedParameterList() 
    { 
        return array( 'gvd' => array( 'result_type' => array( 'type' => 'string',    
                                                              'required' => true, 
                                                              'default' => 'list' ))
                    ); 
    }
 
    /**
     * Depending of the parameters that have been transmitted, fetch objects JACExtensionData 
     * {gvd('list)} or count data {gvd('count')} 
     */ 
    public function modify( $tpl, $operatorName, $operatorParameters, $rootNamespace, $currentNamespace, &$operatorValue, $namedParameters )
    { 
        $result_type = $namedParameters['result_type']; 
        if( $result_type == 'list') 
            $operatorValue = GroupDocsViewer::fetchList(true); 
        else if( $result_type == 'count') 
            $operatorValue = GroupDocsViewer::getListCount(); 
    } 
} 
?>