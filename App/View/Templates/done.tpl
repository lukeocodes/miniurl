        {{message}}

        <div class="panel panel-default">
          <div class="panel-body">
            <form action="." method="post">
              <div class="form-group">
                <label for="exampleInputEmail1">Submit another URL to Shorten:</label>
                <input type="text" class="form-control" name="url" value="{{url}}" placeholder="URL to Shorten">
              </div>
              <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </form>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">URL Shortened!</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-xs-12 col-md-5">
                <img src="./assets/success.png" class="img-responsive center-block img-success"/>
              </div>
              <div class="col-xs-12 col-md-7">
                <p class="lead">You can now use the URL below! :)</p>
                <p style="word-wrap: break-word;">Short URL: <a href="{{urlHash}}" target="_blank">{{urlHash}}</a></p>
                <p style="word-wrap: break-word;">Long URL: <a href="{{url}}" target="_blank">{{url}}</a></p>
              </div>
            </div>
          </div>
        </div>
