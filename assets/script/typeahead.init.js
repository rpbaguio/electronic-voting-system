$(function () {

    var base_url = window.location.origin;

    function autoSuggestChapter() {
        var chapter = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: base_url + '/convention2016/assets/data/regions.json'
        });

        $('.typeahead-chapter').typeahead(null, {
                highlight: true,
                name: 'chapter',
                source: chapter
            }
        );
    }

    autoSuggestChapter();
});