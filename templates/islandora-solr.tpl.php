<?php
/**
 * @file
 * Islandora solr search primary results template file.
 *
 * Variables available:
 * - $results: Primary profile results array
 *
 * @see template_preprocess_islandora_solr()
 */

// If we might have a search, check and save the query needle
$args = explode('/', current_path() );
$needle="";
if ( count($args) >2 ) {
 if($args[1] === "search") { $needle = $args[2]; }
}

?>
<?php if (empty($results)): ?>
 <h2>No matches found</h2>
 <p class="no-results">Sorry, but your search didn't match any items on this site.</p>
 
 <h3>Want to Keep Looking?</h4>
 <p>You may find more results, including items that haven't been digitized, by <a href="https://ou-primo.hosted.exlibrisgroup.com/primo-explore/search?query=any,contains,<?php print $needle ?>&facet=local6,include,special_collections&search_scope=default_scope&vid=OUNEW&sortby=rank">searching special collections</a> in the OU Libraries catalog. </p>
 <p> </p>

<?php else: ?>
  <div class="islandora islandora-solr-search-results">
    <?php $row_result = 0; ?>
    <?php foreach($results as $key => $result): ?>
      <!-- Search result -->
      <div class="islandora-solr-search-result clear-block <?php print $row_result % 2 == 0 ? 'odd' : 'even'; ?>">
        <div class="islandora-solr-search-result-inner">
          <!-- Thumbnail -->
          <dl class="solr-thumb">
            <dt>
              <?php print $result['thumbnail']; ?>
            </dt>
            <dd></dd>
          </dl>
          <!-- Metadata -->
          <dl class="solr-fields islandora-inline-metadata">
            <?php foreach($result['solr_doc'] as $key => $value): ?>
              <dt class="solr-label <?php print $value['class']; ?>">
                <?php print $value['label']; ?>
              </dt>
              <dd class="solr-value <?php print $value['class']; ?>">
                <?php print $value['value']; ?>
              </dd>
            <?php endforeach; ?>
          </dl>
        </div>
      </div>
    <?php $row_result++; ?>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
