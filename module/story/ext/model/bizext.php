<?php
public function update($storyID)
{
    return $this->loadExtension('bizext')->update($storyID);
}

public function subdivide($storyID, $stories) 
{
    return $this->loadExtension('bizext')->subdivide($storyID, $stories);
}

public function getRelation($storyID, $storyType) 
{
    return $this->loadExtension('bizext')->getRelation($storyID, $storyType);
}

public function getAffectedScope($story)
{
    return $this->loadExtension('bizext')->getAffectedScope($story);
}

public function getEmptySR($productID = 0, $branch = 0, $moduleIdList = 0, $status = 'all', $type = 'story', $orderBy = 'id_desc', $pager = null)
{
    return $this->loadExtension('bizext')->getEmptySR($productID, $branch, $moduleIdList, $status, $type, $orderBy, $pager);
}
