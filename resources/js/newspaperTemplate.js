if (app.scriptArgs.isDefined("chose")) {
    var chose = app.scriptArgs.getValue("chose");
}
if (app.scriptArgs.isDefined("get_image_num")) {
    var get_image_num = app.scriptArgs.getValue("get_image_num");
}
if (app.scriptArgs.isDefined("get_pic")) {
    var get_pic = app.scriptArgs.getValue("get_pic");
}
if (app.scriptArgs.isDefined("R")) {
    var R = app.scriptArgs.getValue("R");
}
if (app.scriptArgs.isDefined("G")) {
    var G = app.scriptArgs.getValue("G");
}
if (app.scriptArgs.isDefined("B")) {
    var B = app.scriptArgs.getValue("B");
}
if (app.scriptArgs.isDefined("text_title")) {
    var text_title = app.scriptArgs.getValue("text_title");
}
if (app.scriptArgs.isDefined("text_author")) {
    var text_author = app.scriptArgs.getValue("text_author");
}
if (app.scriptArgs.isDefined("text_content")) {
    var text_content = app.scriptArgs.getValue("text_content");
}
if (app.scriptArgs.isDefined("text_summary")) {
    var text_summary = app.scriptArgs.getValue("text_summary");
}
main(chose,get_image_num,get_pic,R,G,B,text_title,text_author,text_content,text_summary);
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function main(chose,get_image_num,get_pic,R,G,B,text_title,text_author,text_content,text_summary){
    var myDocument = app.documents.add();
    var n=10;
    var image_num=new Array(0,2,1,1,1,6,1,2);
    var image_get=new Array();
    var image_present=new Array();
    var first_page=true;
    for(i=0;i<1000;i++){
        image_get[i]=undefined;
        image_present[i]=false;
    }
    var num=0;//counter
    for(var i=0;i<get_pic.length;){
        if(i<get_pic.length&&get_pic[i]=="q"){
            num++;
            i++;
            image_get[num]="";
            image_present[num]=true;
        }
        else while(i<get_pic.length&&get_pic[i]!="q"){
            image_get[num]+=get_pic[i];
            i++;
        }
    }

    var num_get=1;
    var erase=false;
    while(chose>0){
        var ch=chose%n;
        chose=Math.floor(chose/n);
        if(first_page){
            if(ch==1){
                model1(myDocument,text_title,text_author,text_summary,text_content,R,G,B,image_get[num_get++],image_get[num_get++]);
            }
            else if(ch==2){
                model2(myDocument,text_title,text_author,text_summary,text_content,R,G,B,image_get[num_get++]);
            }
            else if(ch==3){
                model3(myDocument,text_title,text_author,text_summary,text_content,R,G,B,image_get[num_get++]);
            }
            else if(ch==4){
                model4(myDocument,text_title,text_author,text_content,R,G,B,image_get[num_get++]);
            }
            else if(ch==5){
                model5(myDocument,text_title,text_author,text_content,R,G,B,image_get[num_get++],image_get[num_get++],image_get[num_get++],image_get[num_get++],image_get[num_get++],image_get[num_get++]);
            }
            first_page=false;
        }
        else{
            erase=true;
            if(ch==6){
                model6(myDocument,image_get[num_get++],image_present[num_get-1]);
            }
            else if(ch==7){
                model7(myDocument,image_get[num_get++],image_get[num_get++],image_present[num_get-2],image_present[num_get-1]);
            }
            else if(ch==8){
                //
            }
        }
    }
    fit();
    if(erase)del(myDocument);
    print(myDocument);
}
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function model1(myDocument,tfile,afile,sfile,cfile,R,G,B,p1,p2){//1612
    with(myDocument.documentPreferences){
        pageHeight = "340mm";
        pageWidth = "230mm";
        pageOrientation = PageOrientation.portrait;
        pagesPerDocument = 1;
    }
    var firstpage = myDocument.pages.item(0);
    firstpage.marginPreferences.properties = {
        top : 20,
        left: 20,
        right: 20,
        bottom:20
    };
    //-----------------------------------------------------------------------------------------------------------------------
    if(tfile==undefined){
        text = File("/C/Users/Administrator/Desktop/title.txt");
        text.open("r");
        titlefile="";
        titlefile+=text.read();
    }
    else {
        titlefile=tfile;
    }
    if(afile==undefined){
        text = File("/C/Users/Administrator/Desktop/author.txt");
        text.open("r");
        authorfile="";
        authorfile+=text.read();
    }
    else {
        authorfile=afile;
    }

    if(sfile==undefined){
        text = File("/C/Users/Administrator/Desktop/summary.txt");
        text.open("r");
        summaryfile="";
        summaryfile+=text.read();
    }
    else {
        summaryfile=sfile;
    }

    if(cfile==undefined){
        text = File("/C/Users/Administrator/Desktop/content.txt");
        text.open("r");
        contentfile="";
        contentfile+=text.read();
    }else {
        text = File(cfile);
        text.open("r");
        contentfile="";
        contentfile+=text.read();
    }

    if(p1==undefined)
        picture1 = File ("/C/Users/Administrator/Desktop/ttt.png");
    else picture1 = File (p1);
    picture1.open=("r");

    if(p2==undefined)
        picture2 = File ("/C/Users/Administrator/Desktop/ttt.png");
    else  picture2 = File (p2);
    picture2.open=("r");

    if(R==undefined)color = makeColor(myDocument,"temp2", ColorSpace.RGB, ColorModel.process, [255,0,0]);
    else color=makeColor(myDocument,"temp2", ColorSpace.RGB, ColorModel.process, [R,G,B]);
    //-----------------------------------------------------------------------------------------------------------------------
    green = makeColor(myDocument,"temp1", ColorSpace.RGB, ColorModel.process, [152,210,198]);
    bg = color;
    //-----------------------------------------------------------------------------------------------------------------------
    var DLartist = firstpage.textFrames.add();
    DLartist.geometricBounds = [20, 20, 20+5.2, 20+166.8];
    DLartist.contents = "Designed by DLarist"
    DLartist.fillColor=green;
    DLartist.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("Intel Clear");
    DLartist.parentStory.paragraphs.item(0).justification=Justification.CENTER_ALIGN;
    DLartist.parentStory.paragraphs.item(0).pointSize=14;

    var title = firstpage.textFrames.add();
    title.geometricBounds = [33.5, 20,33.5+17.5, 20+166.5];
    title.contents =titlefile;
    title.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("LOGO");
    title.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    title.parentStory.paragraphs.item(0).pointSize=48;

    var author = firstpage.textFrames.add();
    author.geometricBounds = [51, 20,50+7.35, 20+86.5];
    author.contents =authorfile;
    author.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("sst");
    author.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    author.parentStory.paragraphs.item(0).pointSize = 16;
    author.parentStory.paragraphs.item(0).underline = true;

    var summary = firstpage.textFrames.add();
    summary.geometricBounds = [71, 20,71+29, 20+190];
    summary.contents =summaryfile;
    summary.characters[0].fillColor = bg;
    summary.parentStory.paragraphs.item(0).dropCapCharacters =1;
    summary.parentStory.paragraphs.item(0).dropCapLines =2;
    summary.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("LOGO");
    summary.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    summary.parentStory.paragraphs.item(0).pointSize = 14;

    var content = firstpage.textFrames.add();
    content.geometricBounds = [115.25, 20,115.25+204.75, 20+190];
    content.contents =contentfile;
    content.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("sst");
    content.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    content.parentStory.paragraphs.item(0).pointSize =10;
    content.textFramePreferences.textColumnCount=2;
    content.textFramePreferences.verticalBalanceColumns=true;
    //-----------------------------------------------------------------------------------------------------------------------
    var user_icon = firstpage.rectangles.add({geometricBounds:[20, 186.7, 20+32.3, 186.7+23]});
    user_icon.strokeWeight  = '0 pt'
    user_icon.place(picture1, false);

    var image1 = firstpage.rectangles.add({geometricBounds:[116, 68, 116+135.5, 68+94]});
    image1.strokeWeight  = '0 pt'
    image1.place(picture2,false);
    image1.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
    image1.textWrapPreferences.textWrapOffset = [2,2,2,2];

}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function model2(myDocument,tfile,afile,sfile,cfile,R,G,B,p1){//1472
    with(myDocument.documentPreferences){
        pageHeight = "340mm";
        pageWidth = "230mm";
        pageOrientation = PageOrientation.portrait;
        pagesPerDocument = 1;
    }
    var firstpage = myDocument.pages.item(0);
    firstpage.marginPreferences.properties = {
        top : 20,
        left: 20,
        right: 20,
        bottom:20
    };
    //-----------------------------------------------------------------------------------------------------------------------
    if(tfile==undefined){
        text = File("/C/Users/Administrator/Desktop/title.txt");
        text.open("r");
        titlefile="";
        titlefile+=text.read();
    }
    else {
        titlefile=tfile;
    }
    if(afile==undefined){
        text = File("/C/Users/Administrator/Desktop/author.txt");
        text.open("r");
        authorfile="";
        authorfile+=text.read();
    }
    else {
        authorfile=afile;
    }

    if(sfile==undefined){
        text = File("/C/Users/Administrator/Desktop/summary.txt");
        text.open("r");
        summaryfile="";
        summaryfile+=text.read();
    }
    else {
        summaryfile=sfile;
    }
    if(cfile==undefined){
        text = File("/C/Users/Administrator/Desktop/content.txt");
        text.open("r");
        contentfile="";
        contentfile+=text.read();
    }else {
        text = File(cfile);
        text.open("r");
        contentfile="";
        contentfile+=text.read();
    }

    if(p1==undefined)
        picture1 = File ("/C/Users/Administrator/Desktop/ttt.png");
    else picture1 = File (p1);
    picture1.open=("r");

    if(R==undefined)color = makeColor(myDocument,"temp2", ColorSpace.RGB, ColorModel.process, [255,0,0]);
    else color=makeColor(myDocument,"temp2", ColorSpace.RGB, ColorModel.process, [R,G,B]);
    //-----------------------------------------------------------------------------------------------------------------------
    color2 = color;
    //-----------------------------------------------------------------------------------------------------------------------
    var title = firstpage.textFrames.add();
    title.geometricBounds = [239.25, 20,239.25+18.25, 20+190];
    title.contents =titlefile;
    title.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("LOGO");
    title.parentStory.paragraphs.item(0).justification=Justification.CENTER_ALIGN;
    title.parentStory.paragraphs.item(0).pointSize=60;

    var author = firstpage.textFrames.add();
    author.geometricBounds = [257.5, 20,257.5+10, 20+190];
    author.contents =authorfile;
    author.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("sst");
    author.parentStory.paragraphs.item(0).justification=Justification.CENTER_ALIGN;
    author.parentStory.paragraphs.item(0).pointSize = 18;
    author.parentStory.paragraphs.item(0).underline = true;

    var summary = firstpage.textFrames.add();
    summary.geometricBounds = [268, 20,268+42, 20+190];
    summary.contents =summaryfile;
    summary.characters[0].fillColor = color2;
    summary.parentStory.paragraphs.item(0).dropCapCharacters =1;
    summary.parentStory.paragraphs.item(0).dropCapLines =2;
    summary.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("LOGO");
    summary.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    summary.parentStory.paragraphs.item(0).pointSize = 18;

    var content = firstpage.textFrames.add();
    content.geometricBounds = [34, 20,34+190, 20+190];
    content.contents =contentfile;
    content.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("sst");
    content.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    content.parentStory.paragraphs.item(0).pointSize =10;
    content.textFramePreferences.textColumnCount=2;
    content.textFramePreferences.verticalBalanceColumns=true;
    //-----------------------------------------------------------------------------------------------------------------------
    var image1 = firstpage.rectangles.add({geometricBounds:[20 ,66, 20+141.5, 66+98]});
    image1.strokeWeight  = '0 pt'
    image1.place(picture1,false);
    image1.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
    image1.textWrapPreferences.textWrapOffset = [2,2,2,2];
}


//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function model3(myDocument,tfile,afile,sfile,cfile,R,G,B,p1){//1389
    with(myDocument.documentPreferences){
        pageHeight = "340mm";
        pageWidth = "230mm";
        pageOrientation = PageOrientation.portrait;
        pagesPerDocument = 1;
    }
    var firstpage = myDocument.pages.item(0);
    firstpage.marginPreferences.properties = {
        top : 20,
        left: 20,
        right: 20,
        bottom:20
    };
    //-----------------------------------------------------------------------------------------------------------------------
    if(tfile==undefined){
        text = File("/C/Users/Administrator/Desktop/title.txt");
        text.open("r");
        titlefile="";
        titlefile+=text.read();
    }
    else {
        titlefile=tfile;
    }
    if(afile==undefined){
        text = File("/C/Users/Administrator/Desktop/author.txt");
        text.open("r");
        authorfile="";
        authorfile+=text.read();
    }
    else {
        authorfile=afile;
    }

    if(sfile==undefined){
        text = File("/C/Users/Administrator/Desktop/summary.txt");
        text.open("r");
        summaryfile="";
        summaryfile+=text.read();
    }
    else {
        summaryfile=sfile;
    }

    if(cfile==undefined){
        text = File("/C/Users/Administrator/Desktop/content.txt");
        text.open("r");
        contentfile="";
        contentfile+=text.read();
    }else {
        text = File(cfile);
        text.open("r");
        contentfile="";
        contentfile+=text.read();
    }

    if(p1==undefined)
        picture1 = File ("/C/Users/Administrator/Desktop/ttt.png");
    else picture1 = File (p1);
    picture1.open=("r");

    if(R==undefined)color = makeColor(myDocument,"temp2", ColorSpace.RGB, ColorModel.process, [255,0,0]);
    else color=makeColor(myDocument,"temp2", ColorSpace.RGB, ColorModel.process,[R,G,B]);
    //-----------------------------------------------------------------------------------------------------------------------
    black = makeColor(myDocument,"temp1", ColorSpace.RGB, ColorModel.process, [0,0,0]);
    color2 = color;
    white = makeColor(myDocument,"temp3", ColorSpace.RGB, ColorModel.process, [255,255,255]);
    //-----------------------------------------------------------------------------------------------------------------------
    var DLartist = firstpage.textFrames.add();
    DLartist.geometricBounds = [252, 136.25,252+16.34, 136.25+39.75];
    DLartist.contents = "Designed\nby\nDLarist"
    DLartist.fillColor=black;
    for(i=0;i<DLartist.characters.length;i++)DLartist.characters[i].fillColor = white;
    DLartist.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("Intel Clear");
    DLartist.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    DLartist.parentStory.paragraphs.item(0).pointSize=14;
    DLartist.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
    DLartist.textWrapPreferences.textWrapOffset = [0,2,0,2];

    var title = firstpage.textFrames.add();
    title.geometricBounds = [43.5, 20,43.5+18.5, 20+190];
    title.contents =titlefile;
    title.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("Intel Clear");
    title.parentStory.paragraphs.item(0).justification=Justification.CENTER_ALIGN;
    title.parentStory.paragraphs.item(0).pointSize=48;

    var author = firstpage.textFrames.add();
    author.geometricBounds = [30, 20,30+10, 20+52];
    author.contents =authorfile;
    author.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("LOGO");
    author.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    author.parentStory.paragraphs.item(0).pointSize = 18;
    author.parentStory.paragraphs.item(0).underline = true;

    var summary = firstpage.textFrames.add();
    summary.geometricBounds = [64, 20,64+32.75, 20+190];
    summary.contents =summaryfile;
    summary.characters[0].fillColor = color2;
    summary.parentStory.paragraphs.item(0).dropCapCharacters =1;
    summary.parentStory.paragraphs.item(0).dropCapLines =2;
    summary.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("LOGO");
    summary.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    summary.parentStory.paragraphs.item(0).pointSize = 18;

    var content = firstpage.textFrames.add();
    content.geometricBounds = [105.2, 20,105.2+217.5, 20+190];
    content.contents =contentfile;
    content.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("sst");
    content.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    content.parentStory.paragraphs.item(0).pointSize =10;
    content.textFramePreferences.textColumnCount=2;
    content.textFramePreferences.verticalBalanceColumns=true;
    //-----------------------------------------------------------------------------------------------------------------------
    var image1 = firstpage.rectangles.add({geometricBounds:[105.6 ,53.8, 105.6+144.674, 53.8+122.147]});
    image1.strokeWeight  = '0 pt'
    image1.place(picture1,false);
    image1.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
    image1.textWrapPreferences.textWrapOffset = [2,2,2,2];
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function model4(myDocument,tfile,afile,cfile,R,G,B,p1){//1140
    with(myDocument.documentPreferences){
        pageHeight = "340mm";
        pageWidth = "230mm";
        pageOrientation = PageOrientation.portrait;
        pagesPerDocument = 1;
    }
    var firstpage = myDocument.pages.item(0);
    firstpage.marginPreferences.properties = {
        top : 20,
        left: 20,
        right: 20,
        bottom:20
    };
    //-----------------------------------------------------------------------------------------------------------------------
    if(tfile==undefined){
        text = File("/C/Users/Administrator/Desktop/title.txt");
        text.open("r");
        titlefile="";
        titlefile+=text.read();
    }
    else {
        titlefile=tfile;
    }
    if(afile==undefined){
        text = File("/C/Users/Administrator/Desktop/author.txt");
        text.open("r");
        authorfile="";
        authorfile+=text.read();
    }
    else {
        authorfile=afile;
    }
    if(cfile==undefined){
        text = File("/C/Users/Administrator/Desktop/content.txt");
        text.open("r");
        contentfile="";
        contentfile+=text.read();
    }else {
        text = File(cfile);
        text.open("r");
        contentfile="";
        contentfile+=text.read();
    }

    if(p1==undefined)
        picture1 = File ("/C/Users/Administrator/Desktop/ttt.png");
    else picture1 = File (p1);
    picture1.open=("r");

    if(R==undefined)color = makeColor(myDocument,"temp2", ColorSpace.RGB, ColorModel.process, [255,0,0]);
    else color=makeColor(myDocument,"temp2", ColorSpace.RGB, ColorModel.process, [R,G,B]);
    //-----------------------------------------------------------------------------------------------------------------------
    green = makeColor(myDocument,"temp1", ColorSpace.RGB, ColorModel.process, [152,210,198]);
    bg = color;
    //-----------------------------------------------------------------------------------------------------------------------
    var DLartist = firstpage.textFrames.add();
    DLartist.geometricBounds = [20, 20, 20+5.2, 20+190];
    DLartist.contents = "Designed by DLarist"
    DLartist.fillColor=green;
    DLartist.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("Intel Clear");
    DLartist.parentStory.paragraphs.item(0).justification=Justification.CENTER_ALIGN;
    DLartist.parentStory.paragraphs.item(0).pointSize=14;

    var title = firstpage.textFrames.add();
    title.geometricBounds = [28, 129.5,28+35.25, 129.5+80.5];
    title.contents =titlefile;
    title.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("LOGO");
    title.parentStory.paragraphs.item(0).justification=Justification.CENTER_ALIGN;
    title.parentStory.paragraphs.item(0).pointSize=39;

    var author = firstpage.textFrames.add();
    author.geometricBounds = [64, 130.5,64+8.15, 130.5+79.5];
    author.contents =authorfile;
    for(i=0;i<author.characters.length;i++)author.characters[i].fillColor = bg;
    author.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("LOGO");
    author.parentStory.paragraphs.item(0).justification=Justification.CENTER_ALIGN;
    author.parentStory.paragraphs.item(0).pointSize = 12;
    author.parentStory.paragraphs.item(0).underline = true;

    var content = firstpage.textFrames.add();
    content.geometricBounds = [74.5, 130.4,74.5+245.5, 130.4+79.6];
    content.contents =contentfile;
    content.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("sst");
    content.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    content.parentStory.paragraphs.item(0).pointSize =10;
    content.textFramePreferences.textColumnCount=2;
    content.textFramePreferences.verticalBalanceColumns=true;
    //-----------------------------------------------------------------------------------------------------------------------
    var image1 = firstpage.rectangles.add({geometricBounds:[25.2, 20, 25.2+294.8, 20+109.5]});
    image1.strokeWeight  = '0 pt'
    image1.place(picture1,false);
    image1.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
    image1.textWrapPreferences.textWrapOffset = [0,0,0,0];
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function model5(myDocument,tfile,afile,cfile,R,G,B,p1,p2,p3,p4,p5,p6){//1548
    with(myDocument.documentPreferences){
        pageHeight = "340mm";
        pageWidth = "230mm";
        pageOrientation = PageOrientation.portrait;
        pagesPerDocument = 1;
    }
    var firstpage = myDocument.pages.item(0);
    firstpage.marginPreferences.properties = {
        top : 20,
        left: 20,
        right: 20,
        bottom:20
    };
    //-----------------------------------------------------------------------------------------------------------------------
    if(tfile==undefined){
        text = File("/C/Users/Administrator/Desktop/title.txt");
        text.open("r");
        titlefile="";
        titlefile+=text.read();
    }
    else {
        titlefile=tfile;
    }
    if(afile==undefined){
        text = File("/C/Users/Administrator/Desktop/author.txt");
        text.open("r");
        authorfile="";
        authorfile+=text.read();
    }
    else {
        authorfile=afile;
    }
    if(cfile==undefined){
        text = File("/C/Users/Administrator/Desktop/content.txt");
        text.open("r");
        contentfile="";
        contentfile+=text.read();
    }else {
        text = File(cfile);
        text.open("r");
        contentfile="";
        contentfile+=text.read();
    }

    if(p1==undefined){
        picture1 = File ("/C/Users/Administrator/Desktop/ttt.png");
    }else picture1= File (p1);
    picture1.open=("r");

    if(p2==undefined){
        picture2 = File ("/C/Users/Administrator/Desktop/ttt.png");
    }else picture2= File (p2);
    picture2.open=("r");
    if(p3==undefined){
        picture3 = File ("/C/Users/Administrator/Desktop/ttt.png");
    }else picture3= File (p3);
    picture3.open=("r");
    if(p4==undefined){
        picture4 = File ("/C/Users/Administrator/Desktop/ttt.png");
    }else picture4= File (p4);
    picture4.open=("r");
    if(p5==undefined){
        picture5 = File ("/C/Users/Administrator/Desktop/ttt.png");
    }else picture5= File (p5);
    picture5.open=("r");
    if(p6==undefined){
        picture6 = File ("/C/Users/Administrator/Desktop/ttt.png");
    }else picture6= File (p6);
    picture6.open=("r");
    if(R==undefined)color = makeColor(myDocument,"temp2", ColorSpace.RGB, ColorModel.process, [255,0,0]);
    else color=makeColor(myDocument,"temp2", ColorSpace.RGB, ColorModel.process, [R,G,B]);
    //-----------------------------------------------------------------------------------------------------------------------
    black = makeColor(myDocument,"black", ColorSpace.RGB, ColorModel.process, [0,0,0]);
    white = makeColor(myDocument,"white", ColorSpace.RGB, ColorModel.process, [255,255,255]);
    gray= makeColor(myDocument,"gray",ColorSpace.CMYK, ColorModel.process, [25,18,18,0]);
    color2 = color;
    //-----------------------------------------------------------------------------------------------------------------------
    var DLartist = firstpage.textFrames.add();
    DLartist.geometricBounds = [20, 20,20+ 10, 20+190];
    DLartist.contents = "Designed by DLarist"
    DLartist.fillColor=black;
    for(i=0;i<DLartist.characters.length;i++)DLartist.characters[i].fillColor=white;
    DLartist.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("Intel Clear");
    DLartist.parentStory.paragraphs.item(0).justification=Justification.CENTER_ALIGN;
    DLartist.parentStory.paragraphs.item(0).pointSize=24;

    var placeHolder2 = firstpage.textFrames.add();
    placeHolder2.geometricBounds=[30.5, 76.5, 30.5+107.5, 76.5+90.05];
    placeHolder2.contents="D";
    placeHolder2.characters[0].fillColor=gray;
    placeHolder2.parentStory.paragraphs.item(0).pointSize=340;

    var title = firstpage.textFrames.add();
    title.geometricBounds = [68.5, 79,58.5+64.5, 79+131];
    title.contents =titlefile;
    title.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("LOGO");
    title.parentStory.paragraphs.item(0).justification=Justification.RIGHT_ALIGN;
    title.parentStory.paragraphs.item(0).pointSize=48;

    var author = firstpage.textFrames.add();
    author.geometricBounds = [113, 93,113+4.3, 93+117];
    author.contents =authorfile;
    author.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("LOGO");
    author.parentStory.paragraphs.item(0).justification=Justification.RIGHT_ALIGN;
    author.parentStory.paragraphs.item(0).pointSize = 12;
    author.parentStory.paragraphs.item(0).underline = true;

    var content = firstpage.textFrames.add();
    content.geometricBounds = [137.7, 77.25,137.7+182.3, 77.25+132.75];
    content.contents =contentfile;
    content.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("sst");
    content.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    content.parentStory.paragraphs.item(0).pointSize =10;
    content.textFramePreferences.textColumnCount=2;
    content.textFramePreferences.verticalBalanceColumns=true;
    //-----------------------------------------------------------------------------------------------------------------------
    var placeHolder1 = firstpage.rectangles.add({geometricBounds:[30, 20, 30+290, 20+50]});
    placeHolder1.strokeWeight  = '0 pt';
    placeHolder1.fillColor=gray;

    var image1 = firstpage.ovals.add({geometricBounds:[20, 165, 20+45, 166+45]});
    image1.strokeWeight  = '0 pt'
    image1.place(picture1,false);

    var image2 = firstpage.ovals.add({geometricBounds:[30, 16, 30+60, 16+60]});
    image2.strokeWeight  = '0 pt'
    image2.place(picture2,false);
    var image3 = firstpage.ovals.add({geometricBounds:[88.75, 16, 88.75+60,16+60,]});
    image3.strokeWeight  = '0 pt'
    image3.place(picture3,false);
    var image4 = firstpage.ovals.add({geometricBounds:[147.5,16, 147.5+60, 16+60]});
    image4.strokeWeight  = '0 pt'
    image4.place(picture4,false);
    var image5 = firstpage.ovals.add({geometricBounds:[206.25,16, 206.25+60,16+60]});
    image5.strokeWeight  = '0 pt'
    image5.place(picture5,false);
    var image6 = firstpage.ovals.add({geometricBounds:[260,16, 260+60, 16+60]});
    image6.strokeWeight  = '0 pt'
    image6.place(picture6,false);
}


//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function model6(myDocument,picture1,f1){//can't be the last page!
    doc = myDocument
    newPage = doc.pages.add();
    newPage.marginPreferences.properties = {
        top : 20,
        left: 20,
        right: 20,
        bottom:20
    };
    oldRuler = doc.viewPreferences.rulerOrigin
    doc.viewPreferences.rulerOrigin = RulerOrigin.pageOrigin;
    //-----------------------------------------------------------------------------------------------------------------------
    if(picture1==undefined)
        picture1 = File ("/C/Users/Administrator/Desktop/ttt.png");
    else picture1 = File (picture1);
    picture1.open=("r");
    //-----------------------------------------------------------------------------------------------------------------------
    var content_fellow = newPage.textFrames.add();
    content_fellow.geometricBounds = [20, 20,
        doc.documentPreferences.pageHeight - 20,
        doc.documentPreferences.pageWidth - 20];
    content_fellow.previousTextFrame = doc.pages[-2].textFrames[0];
    content_fellow.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("sst");
    content_fellow.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    content_fellow.parentStory.paragraphs.item(0).pointSize =10;
    content_fellow.textFramePreferences.textColumnCount=2;
    content_fellow.textFramePreferences.verticalBalanceColumns=true;
    //-----------------------------------------------------------------------------------------------------------------------
    if(f1){
        var placeHolder2= newPage.rectangles.add({geometricBounds:[283.2, 117 ,283.2+36.824, 117+93]});
        placeHolder2.strokeWeight  = '0 pt'
        placeHolder2.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
    }
    if(f1){
        var image1 = newPage.rectangles.add({geometricBounds:[151, 117 ,151+131.5, 117+93]});
        image1.strokeWeight  = '0 pt'
        image1.place(File(picture1),false);
        image1.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
        image1.textWrapPreferences.textWrapOffset = [2,2,2,2];
    }
    //-----------------------------------------------------------------------------------------------------------------------
    doc.viewPreferences.rulerOrigin = oldRuler;
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function model7(myDocument,picture1,picture2,f1,f2){//can be the last page.
    doc = myDocument
    newPage = doc.pages.add();
    newPage.marginPreferences.properties = {
        top : 20,
        left: 20,
        right: 20,
        bottom:20
    };
    oldRuler = doc.viewPreferences.rulerOrigin
    doc.viewPreferences.rulerOrigin = RulerOrigin.pageOrigin;
    //-----------------------------------------------------------------------------------------------------------------------
    if(picture1==undefined)
        picture1 = File ("/C/Users/Administrator/Desktop/ttt.png");
    else picture1 = File (picture1);
    picture1.open=("r");
    if(picture2==undefined)
        picture2 = File ("/C/Users/Administrator/Desktop/ttt.png");
    else picture2=File(picture2);
    picture2.open=("r");
    //-----------------------------------------------------------------------------------------------------------------------
    var content_fellow = newPage.textFrames.add();
    content_fellow.geometricBounds = [20, 20,
        doc.documentPreferences.pageHeight - 20,
        doc.documentPreferences.pageWidth - 20];
    content_fellow.previousTextFrame = doc.pages[-2].textFrames[0];
    content_fellow.parentStory.paragraphs.item(0).appliedFont = app.fonts.item("sst");
    content_fellow.parentStory.paragraphs.item(0).justification=Justification.LEFT_ALIGN;
    content_fellow.parentStory.paragraphs.item(0).pointSize =10;
    content_fellow.textFramePreferences.textColumnCount=2;
    content_fellow.textFramePreferences.verticalBalanceColumns=true;
    //-----------------------------------------------------------------------------------------------------------------------
    if(f1&&f2){
        var placeHolder1 = newPage.rectangles.add({geometricBounds:[20, 87.32, 20+48.5, 87.32+122.68]});
        placeHolder1.strokeWeight  = '0 pt'
        placeHolder1.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
    }
    if(f1){
        var image2= newPage.rectangles.add({geometricBounds:[33,140 ,33+105.5, 140+94.1]});
        image2.strokeWeight  = '0 pt'
        image2.absoluteRotationAngle=-16.5;
        image2.place(File(picture2),false);
        image2.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
        image2.textWrapPreferences.textWrapOffset = [2,2,2,2];
    }
    if(f2){
        var image1 = newPage.rectangles.add({geometricBounds:[33.275, 53.592 ,33.275+94.3, 53.592+88]});
        image1.strokeWeight  = '0 pt'
        image1.absoluteRotationAngle=15;
        image1.place(File(picture1),false);
        image1.textWrapPreferences.textWrapMode = TextWrapModes.BOUNDING_BOX_TEXT_WRAP;
        image1.textWrapPreferences.textWrapOffset = [2,2,2,2];
    }
    //-----------------------------------------------------------------------------------------------------------------------
    doc.viewPreferences.rulerOrigin = oldRuler;
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function model8(){

}


//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function makeColor(myDocument,colorName, colorSpace, colorModel, colorValue) {
    R=parseInt(colorValue[0]);G=parseInt(colorValue[1]);B=parseInt(colorValue[2]);
    var doc = myDocument;
    var color = doc.colors.item(colorName);
    if(color.isValid)
        color = doc.colors.remove({name: colorName, space: colorSpace, model: colorModel, colorValue:[R,G,B]});
    color = myDocument.colors.add({name: colorName, space:ColorSpace.RGB, model:ColorModel.process,colorValue:[R,G,B]});
    return color;
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function del(myDocument) {
    var doc =myDocument;
    var last_frame = doc.pages[-1].textFrames[0];
    var geo= doc.pages[-1].textFrames[0].geometricBounds;
    var now_height = geo[2]-geo[0];
    if(now_height<2){doc.pages[-1].remove();}
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function fit(){
    app.documents[0].rectangles.everyItem().fit(FitOptions.CONTENT_TO_FRAME);
    app.documents[0].ovals.everyItem().fit(FitOptions.CONTENT_TO_FRAME);
    for(i=0;i<app.documents[0].textFrames.length;i++){
        if(app.documents[0].textFrames[i].contents=="Designed by DLarist"||app.documents[0].textFrames[i].contents=="Designed\nby\nDLarist")continue;
        app.documents[0].textFrames[i].fit(FitOptions.FRAME_TO_CONTENT);
    }
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
function print(myDocument){
    myDocument = myDocument;
    var myFilePath = "/C/Users/Administrator/Desktop/final.pdf";
    var myFile = new File(myFilePath);
    myDocument.exportFile(ExportFormat.pdfType, myFile, "Press Quality");
}

