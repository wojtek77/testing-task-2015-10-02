/**
 * @link http://symfony.com/doc/current/cookbook/form/form_collections.html#allowing-new-tags-with-the-prototype
 */

var $minLinks = 1;
var $maxLinks = 5;

var $collectionHolder;

// setup an "add a attachment" link
var $addAttachmentLink = $('<a href="#" class="add__link">Add file</a>');
var $newLinkLi = $('<p></p>').append($addAttachmentLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of attachments
    $collectionHolder = $('ul.attachments');

    // add the "add a attachment" anchor and li to the attachments ul
    $collectionHolder.append($newLinkLi);
    
    // add a delete link to all of the existing attachment form li elements
    $collectionHolder.find('li').each(function() {
        addAttachmentFormDeleteLink($(this));
    });

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', getActualIndex());

    $addAttachmentLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new attachment form (see next code block)
        addAttachmentForm($collectionHolder, $newLinkLi);
    });
    
    // at least one attachment must be add
    if ($collectionHolder.data('index') === 0) {
       addAttachmentForm($collectionHolder, $newLinkLi);
    }
});

function addAttachmentForm($collectionHolder, $newLinkLi) {
    // only 5 attachment can be added
    if (getActualIndex() >= $maxLinks) {
        return;
    }
    
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');
    
    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a attachment" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);
    
    // add a delete link to the new form
    addAttachmentFormDeleteLink($newFormLi);
}

function addAttachmentFormDeleteLink($attachmentFormLi) {
    var $removeFormA = $('<a href="#">delete</a>');
    $attachmentFormLi.append($removeFormA);

    $removeFormA.on('click', function(e) {
        
        // prevent the link from creating a "#" on the URL
        e.preventDefault();
        
        // at least one attachment must be stayed
        if (getActualIndex() <= $minLinks) {
            return;
        }

        // remove the li for the attachment form
        $attachmentFormLi.remove();
    });
}

function getActualIndex() {
    return $collectionHolder.find(':input[type=file]').length;
}
