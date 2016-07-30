function GzFrame(options){

    // Canvas Variables
    this.canvas = options.canvas;
    this.canvasw = options.width;
    this.canvash = options.height;
    this.frameSize = 1024;
    this.panStep = 10;
    this.zoomStep = 0.1;
    this.firstLoad = true;
    this.panEnabled = true;
    this.masks = {
      p: {
        x: 0,
        y: 0,
        width: 1024,
        height:1024,
      },
      l: {
        x: 0,
        y: 0,
        width: 1024,
        height:1024,
      },
      pe: {
        x: 0,
        y: 0,
        width: 1024,
        height:1024,
      },
      le: {
        x: 0,
        y: 0,
        width: 1024,
        height:1024,
      }
    };
    this.smask = "l";
    this.fstage;
    this.bFrame;
    this.bPb;
    this.iBkg;
    this.bBkg;
    this.mFrame;
    this.oldPt;
    this.oldMidPt;

    //this.SetBackgroundImage();

    createjs.Ticker.setFPS(24);

    this.fstage = new createjs.Stage(this.canvas);
    this.fstage.enableDOMEvents(false);
    this.fstage.canvas = document.getElementById(this.canvas);
    this.fstage.autoClear = false;
    this.fstage.enableDOMEvents(true);

    createjs.Touch.enable(this.fstage);

    //Set up the frame and pb placeholders
    this.bPb = new createjs.Bitmap();
    this.bFrame = new createjs.Bitmap();
    this.bBkg = new createjs.Bitmap();

    // Add the mouse events
    this.fstage.addEventListener("mousedown", this.HandleMouseDown(this));
    //this.fstage.addEventListener("mouseup", this.HandleMouseUp(this));
    this.fstage.addEventListener("pressmove" , this.HandleMouseMove(this));

};

GzFrame.prototype.Destroy = function(){
    
    //createjs.Ticker.reset();
    this.fstage.removeAllEventListeners();
    this.fstage.enableDOMEvents(false);
    this.fstage.removeAllChildren();
    this.fstage.clear();
    this.fstage.update();
    
    return true;

};

GzFrame.prototype.PanEnable = function(pState){
    this.panEnabled = pState;
    return this.panEnabled;

};

GzFrame.prototype.ResizeFrame = function(pWidth, pHeight, orientation){

  var scaleref = pWidth;
  var posref = pHeight;
  if( scaleref > pHeight ){ scaleref = pHeight; posref = pWidth; }

  // console.log("scaleref", scaleref);
  // console.log("width", pWidth);
  // console.log("height", pHeight);

  //$(this.canvas).css('transform-origin', 'left top');
  //$(this.canvas).css('transform', 'scale('+(scaleref/this.frameSize)+') translate('+(((pWidth-(1000*(scaleref/this.frameSize)))/2))+'px, '+(((pHeight-(1000*(scaleref/this.frameSize)))/2))+'px)');


  var scale = scaleref/this.frameSize;
  var translateVal = 'scale('+(scale)+') translate('+(((pWidth-(this.frameSize*(scale)))/2))+'px, '+(((pHeight-(this.frameSize*(scale)))/2))+'px)';

  translateVal = 'scale('+(scale)+')';

  var scaleMargin = scale * 107;

  var canvasLeft = (pWidth-(this.frameSize*scale))/2;
  var controlsHeight = scale * 1000 + 84 - scaleMargin * 2;
  var zoom = {right: scale * 126.98 + scaleMargin, top: scale * -276.03};

  return {
    transform: translateVal,
    margin: scaleMargin,
    controlsHeight: controlsHeight,
    zoom: zoom,
    canvasLeft: canvasLeft
  };
};

GzFrame.prototype.SetFrameImage = function(pImg, pOrient){
    var fimg = new Image();
    fimg.src = pImg;
    fimg.onload = this.HandleFrameImage(this, pOrient);
};

GzFrame.prototype.HandleFrameImage = function(self, pOrient){
    return function(event){

        // Add the background
        self.bBkg = new createjs.Shape();
        self.bBkg.x = 0;
        self.bBkg.y = 0;

        self.bFrame = new createjs.Bitmap(event.target);
        self.bFrame.x = 0;
        self.bFrame.y = 0;
        self.bFrame.rotation = 0;
        self.bFrame.name = "frame";
        self.bFrame.cursor = "pointer";

        self.mFrame = new createjs.Shape();
        self.mFrame.x = 0;
        self.mFrame.y = 0;
        if(pOrient=='pe' || pOrient=='le'){
          self.smask = pOrient;
            //self.bBkg.graphics.beginBitmapFill(self.iBkg).drawCircle(self.masks[self.smask].x,self.masks[self.smask].y,self.masks[self.smask].width,self.masks[self.smask].height).closePath();
            self.mFrame.graphics.beginStroke("#FF0").setStrokeStyle(5).drawEllipse(self.masks[self.smask].x,self.masks[self.smask].y,self.masks[self.smask].width,self.masks[self.smask].height).closePath();
        }else{
          self.smask = pOrient;
            //self.bBkg.graphics.beginBitmapFill(self.iBkg).drawRect(self.masks[self.smask].x,self.masks[self.smask].y,self.masks[self.smask].width,self.masks[self.smask].height).closePath();
            self.mFrame.graphics.beginStroke("#FF0").setStrokeStyle(5).drawRect(self.masks[self.smask].x,self.masks[self.smask].y,self.masks[self.smask].width,self.masks[self.smask].height).closePath();
        }

        self.bPb.mask = self.mFrame;

        if( self.firstLoad ){
            self.firstLoad = false;
            self.ZoomArt();
            self.CenterArt();
        }else{
            self.MaintainInFrame();
        }

        self.Refresh();
    };
};

GzFrame.prototype.SetBackgroundImage = function(){
    this.iBkg = new Image();
    this.iBkg.src = 'images/pb_texture_2t.gif';
    this.iBkg.onload = this.HandleBackgroundImage(this);
};

GzFrame.prototype.HandleBackgroundImage = function(){

};

GzFrame.prototype.SetPbImage = function(pImg){
    //console.log('loading img 2', pImg);
    var img = new Image();
    img.src = pImg;
    img.onload = this.HandlePbImage(this);

};

GzFrame.prototype.HandlePbImage = function(self){
    return function(event){
        //console.log(self.fstage);
        //console.log("img loaded", this.width, this.height);
        //star = new createjs.Shape();
        // the mask's position will be relative to the parent of its target:
        //star.x = 20;
        //star.y = 40;
        // only the drawPolyStar call is needed for the mask to work:
        //star.graphics.beginStroke("#FF0").setStrokeStyle(5).drawRect(98,189,783,565).closePath();
        //console.log(event.target);

        // Find the smaller dimension
        var smallsideref = this.width;
        if( this.height < this.width ) smallsideref = this.height;
        var scaleby = 1+((self.frameSize-smallsideref)/smallsideref);

        // console.log('smaller dimension',smallsideref);
        // console.log('scale by',scaleby);


        self.bPb = new createjs.Bitmap(event.target);
        //self.bPb.x = self.frameSize/2-(this.width*(self.frameSize/this.width))/2;
        //self.bPb.y = self.frameSize/2-(this.height*(self.frameSize/this.width))/2;
        self.bPb.x = (self.frameSize-(this.width*scaleby))/2;
        self.bPb.y = (self.frameSize-(this.height*scaleby))/2;
        self.bPb.scaleX = scaleby;
        self.bPb.scaleY = scaleby;
        self.bPb.rotation = 0;
        self.bPb.name = "sav";
        self.bPb.cursor = "pointer";
        self.bPb.mask = self.mFrame;

        self.Refresh();
    };
};

GzFrame.prototype.Refresh = function(){
    // console.log('refreshing sir');
    this.fstage.removeAllChildren();

    //this.fstage.addChild(this.bBkg);
    this.fstage.addChild(this.bPb);
    this.fstage.addChild(this.bFrame);

    this.fstage.clear();
    this.fstage.update();
};

GzFrame.prototype.MoveDown = function(){
    //return function(){
        self.bPb.y += self.panStep;
        self.fstage.clear();
        self.fstage.update();
    //};
};

GzFrame.prototype.MoveUp = function(){
    //return function(){
        self.bPb.y -= self.panStep;
        self.fstage.clear();
        self.fstage.update();
    //};
};

GzFrame.prototype.MoveRight = function(){
    //return function(){
        self.bPb.x += self.panStep;
        self.fstage.clear();
        self.fstage.update();
    //};
};

GzFrame.prototype.MoveLeft = function(){
    //return function(){
        self.bPb.x -= self.panStep;
        self.fstage.clear();
        self.fstage.update();
    //};
};

GzFrame.prototype.ZoomIn = function(){
    //return function(){
    if( this.bPb.scaleX + this.zoomStep < 4 ){
        this.bPb.scaleX += this.zoomStep;
        this.bPb.scaleY += this.zoomStep;
        this.bPb.x += ((this.bPb.getBounds().width*(this.bPb.scaleX - this.zoomStep))-(this.bPb.getBounds().width*this.bPb.scaleX))/2;
        this.bPb.y += ((this.bPb.getBounds().height*(this.bPb.scaleY - this.zoomStep))-(this.bPb.getBounds().height*this.bPb.scaleY))/2;
        //this.CenterArt();
        this.fstage.clear();
        this.fstage.update();

        this.MaintainInFrame();
        return true;
    }
    //};
    return false;
};

GzFrame.prototype.ZoomOut = function(){
    //return function(){
    if( ((this.bPb.getBounds().width*(this.bPb.scaleX - this.zoomStep)) > this.masks[this.smask].width) &&
     ((this.bPb.getBounds().height*(this.bPb.scaleY - this.zoomStep)) > this.masks[this.smask].height) ){
        this.bPb.scaleX -= this.zoomStep;
        this.bPb.scaleY -= this.zoomStep;
        this.bPb.x -= ((this.bPb.getBounds().width*(this.bPb.scaleX - this.zoomStep))-(this.bPb.getBounds().width*this.bPb.scaleX))/2;
        this.bPb.y -= ((this.bPb.getBounds().height*(this.bPb.scaleY - this.zoomStep))-(this.bPb.getBounds().height*this.bPb.scaleY))/2;
        //this.CenterArt();
        this.fstage.clear();
        this.fstage.update();

        this.MaintainInFrame();
        return true;
    }
    //};
    return false;
};

GzFrame.prototype.MaintainInFrame = function(){
    if( this.bPb.x > this.masks[this.smask].x ) this.bPb.x = this.masks[this.smask].x;
    if( this.bPb.y > this.masks[this.smask].y ) this.bPb.y = this.masks[this.smask].y;
    //console.log(this.bPb.x,(this.bPb.getBounds().width*this.bPb.scaleX), this.masks[this.smask].x,this.masks[this.smask].width);
    if( (this.bPb.x+(this.bPb.getBounds().width*this.bPb.scaleX)) < this.masks[this.smask].x+this.masks[this.smask].width ) this.bPb.x = (this.masks[this.smask].x+this.masks[this.smask].width)-(this.bPb.getBounds().width*this.bPb.scaleX);
    if( (this.bPb.y+(this.bPb.getBounds().height*this.bPb.scaleY)) < this.masks[this.smask].y+this.masks[this.smask].height ) this.bPb.y = (this.masks[this.smask].y+this.masks[this.smask].height)-(this.bPb.getBounds().height*this.bPb.scaleY);

    this.fstage.clear();
    this.fstage.update();

    return false;
};

GzFrame.prototype.CenterArt = function(){

    if( typeof this.bPb !== 'undefined' ){
      console.log("centering art");
      //var smallsideref = this.bPb.getBounds().width;
      //if( this.bPb.getBounds().height < this.bPb.getBounds().width ) smallsideref = this.bPb.getBounds().height;
      //var scaleby = 1+((this.frameSize-smallsideref)/smallsideref);

      //this.bPb.x = (this.frameSize-(this.bPb.getBounds().width*scaleby))/2;
      //this.bPb.y = (this.frameSize-(this.bPb.getBounds().height*scaleby))/2;
      console.log(this.frameSize, this.bPb.getBounds().width, this.bPb.scaleX);
      this.bPb.x = (this.frameSize-(this.bPb.getBounds().width*this.bPb.scaleX))/2;
      this.bPb.y = (this.frameSize-(this.bPb.getBounds().height*this.bPb.scaleY))/2;

      this.fstage.clear();
      this.fstage.update();
    }
};

GzFrame.prototype.ZoomArt = function(){

    if( typeof this.bPb !== 'undefined' ){
      var smallsideref = this.bPb.getBounds().width;
      if( this.bPb.getBounds().height < this.bPb.getBounds().width ) smallsideref = this.bPb.getBounds().height;
      var scaleby = 1+((this.frameSize-smallsideref)/smallsideref);

      this.bPb.scaleX = scaleby;
      this.bPb.scaleY = scaleby;

      this.fstage.clear();
      this.fstage.update();
    }
};

GzFrame.prototype.SaveCanvas = function(pName, pEmail, api_path, pSaveResponse){
    var postData = {
        artworkName: '',
        artworkEmail: '',
        artworkImage: '',
        artworkOrientation: '',
        decoy: 'nothinghere',
    };

    // Get png preview of the cloud
    var screenshot = Canvas2Image.saveAsPNG(document.getElementById('pb-frame'), true);
    console.log("screenshot",screenshot);
    console.log("canvas", this.canvas);
    console.log("parentNode", this.canvas.parentNode);

    document.getElementById('frame-container').appendChild(screenshot);
    screenshot.id = "frameimage";
    postData.artworkImage = document.getElementById('frameimage').src;
    document.getElementById('frame-container').removeChild(screenshot);

    postData.artworkName = pName;
    postData.artworkEmail = pEmail;
    postData.artworkOrientation = this.smask.replace("e", "");
    //correct for ellipse

    $.post(api_path+'tinderbox/artwork/add/json',postData,pSaveResponse, 'json');
};

GzFrame.prototype.HandleMouseDown = function(self) {
    return function(event){
        if( self.panEnabled ){
            self.oldPt = new createjs.Point(self.fstage.mouseX, self.fstage.mouseY);
            self.oldMidPt = self.oldPt;
            //console.log(event);
            //self.fstage.addEventListener("mousemove" , self.HandleMouseMove(self));
        }
    };
};

GzFrame.prototype.HandleMouseUp = function(self) {
    return function(event){
        self.fstage.removeEventListener("stagemousemove" , self.HandleMouseMove);
    };
};

GzFrame.prototype.HandleMouseMove = function(self) {
    return function(event){
        if( self.fstage.mouseY > self.masks[self.smask].y &&
            self.fstage.mouseY < self.masks[self.smask].y+self.masks[self.smask].height &&
            self.fstage.mouseX > self.masks[self.smask].x &&
            self.fstage.mouseX < self.masks[self.smask].x+self.masks[self.smask].width ){
          self.bPb.x -= (self.oldPt.x-self.fstage.mouseX);
          self.bPb.y -= (self.oldPt.y-self.fstage.mouseY);
          if( self.bPb.x > self.masks[self.smask].x ) self.bPb.x = self.masks[self.smask].x;
          if( self.bPb.y > self.masks[self.smask].y ) self.bPb.y = self.masks[self.smask].y;
          //console.log(self.bPb.x,(self.bPb.getBounds().width*self.bPb.scaleX), self.masks[self.smask].x,self.masks[self.smask].width);
          if( (self.bPb.x+(self.bPb.getBounds().width*self.bPb.scaleX)) < self.masks[self.smask].x+self.masks[self.smask].width ) self.bPb.x = (self.masks[self.smask].x+self.masks[self.smask].width)-(self.bPb.getBounds().width*self.bPb.scaleX);
          if( (self.bPb.y+(self.bPb.getBounds().height*self.bPb.scaleY)) < self.masks[self.smask].y+self.masks[self.smask].height ) self.bPb.y = (self.masks[self.smask].y+self.masks[self.smask].height)-(self.bPb.getBounds().height*self.bPb.scaleY);
          //if( self.bPb.y < self.masks[self.smask].height-self.bPb.getBounds().height ) self.bPb.y = self.masks[self.smask].height-self.bPb.getBounds().height;
          //console.log(self.bPb.mask);
          //self.masks[self.smask].x,self.masks[self.smask].y,self.masks[self.smask].width,self.masks[self.smask].height
          self.oldPt.x = self.fstage.mouseX;
          self.oldPt.y = self.fstage.mouseY;
          self.fstage.clear();
          self.fstage.update();
      }


    }
};
