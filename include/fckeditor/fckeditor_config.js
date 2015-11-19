FCKConfig.AutoDetectLanguage = true ;

FCKConfig.EnterMode = 'br' ;

FCKConfig.ToolbarSets["Default"] = [
['Source','DocProps','-','Save','NewPage','Preview','-','Templates'],
['Cut','Copy','Paste','PasteText','PasteWord','-','Print','SpellCheck'],
['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
['Form','Checkbox','Radio','TextField','Textarea','Select','Button','ImageButton','HiddenField'],
'/',
['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
['OrderedList','UnorderedList','-','Outdent','Indent','Blockquote'],
['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
['Link','Unlink','Anchor'],
['Image','Flash','Table','Rule','Smiley','SpecialChar','PageBreak'],
'/',
['Style','FontFormat','FontName','FontSize'],
['TextColor','BGColor'],
['FitWindow','ShowBlocks','-','About'] // No comma for the last row.
] ;

FCKConfig.ToolbarSets["Basic"] = [
['Bold','Italic','-','OrderedList','UnorderedList','-','Link','Unlink','-','About']
] ;

FCKConfig.ToolbarSets["MyToolbar"] = [
['FontName','FontSize','TextColor','BGColor','Bold','Italic','Underline','StrikeThrough','JustifyLeft','JustifyCenter','JustifyRight','JustifyFull','Link','Image','Flash','Table','SyntaxHighLight2']
] ;

FCKConfig.ToolbarSets["WToolbar"] = [
['FontName','FontSize','TextColor','BGColor','Bold','Italic','Underline','StrikeThrough','JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
'/',
['Link','Image','Flash','Table','SyntaxHighLight2']
] ;

FCKConfig.ToolbarSets["Reply"] = [
['FontSize','TextColor','BGColor','Bold','Italic','Underline','StrikeThrough','JustifyLeft','JustifyCenter','JustifyRight','JustifyFull','Link','Image','Flash','SyntaxHighLight2']
] ;

//링크 서버보기, 업로드, 속성탭 제외
FCKConfig.LinkBrowser = false ;
FCKConfig.LinkUpload = false ;
FCKConfig.LinkDlgHideTarget  = true ;
FCKConfig.LinkDlgHideAdvanced = true ;

//이미지 서버보기, 링크, 속성탭 제외
FCKConfig.ImageBrowser = false;
FCKConfig.ImageDlgHideLink  = true ;
FCKConfig.ImageDlgHideAdvanced = true ;