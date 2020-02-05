<form action= "@if(ICL_LANGUAGE_CODE=='de') /search/ @else /en/search/ @endif" method="get" input: data-swpengine="supplemental_engine">
	<input class="iav-header-search-btn" type="search"  @if(ICL_LANGUAGE_CODE=='de') placeholder="Suche" @else placeholder="Search" @endif  value="" data-swplive="true" name="fwp_global_search">
	<button class="iav-header-search-btn" type="submit"> </button>
</form>