/*
 * InsertAtCaret: A WYMeditor plugin providing the functionality needed to
 * insert text or html at the current caret (cursor) position.
 *
 * © Copyright 2008 Jonatan Lundin, http://www.ettention.se
 * Dual licensed under the MIT (MIT-license.txt)
 * and GPL (GPL-license.txt) licenses.
 *
 * For further information about WYMeditor visit:
 *        http://www.wymeditor.org/
 *
 * Usage:
 *        yourWymInstance.insertAtCaret('a html snippet');
 *
 * File Name:
 *        jquery.wymeditor.insertatcaret.js
 *        insertAtCaret plugin for WYMeditor
 *
 * File Authors:
 *        Jonatan Lundin (jonatan.lundin _at_ gmail.com)
 *
 * Version:
 *        0.1
 *
 * Changelog:
 *
 * 0.1
 *     - Initial release.
 */

// Works in most browsers except Internet Explorer
WYMeditor.editor.prototype.insertAtCaret = function (html)
{
    // Do we have a selection?
    if (this._iframe.contentWindow.getSelection().focusNode != null) {
        // Overwrite selection with provided html
        this._exec('inserthtml', html);
    } else {
        // Fall back to the internal paste function if there's no selection
        this.paste(html)
    }
};

// IE needs some more help
WYMeditor.WymClassExplorer.prototype.insertAtCaret = function (html)
{
    // Get the current selection
    var range = this._doc.selection.createRange();
    // Reference to the iframe
    var iframe = this._iframe;

    // Check if the current selection is inside the editor
    if (jQuery(range.parentElement()).parents('.wym_iframe').is('*')) {
        try {
            // Overwrite selection with provided html
            range.pasteHTML(html);
        } catch (e) { }
    } else {
        // Fall back to the internal paste function if there's no selection
        this.paste(html);
    }
}