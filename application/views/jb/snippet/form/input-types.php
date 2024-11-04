<h4 class="header-title mb-4">Input Types</h4>

<div class="row">
    <div class="col-12">
        <div class="">
            <form class="form-horizontal">
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Text</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" value="Some text value...">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="example-email">Email</label>
                    <div class="col-lg-10">
                        <input type="email" id="example-email" name="example-email" class="form-control" placeholder="Email">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Static</label>
                    <div class="col-md-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>



                <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="example-password">Password</label>
                    <div class="col-lg-10">
                        <input type="password" id="example-password" class="form-control" value="password">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="example-placeholder">Placeholder</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="example-placeholder" placeholder="placeholder">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="example-textarea">Text area</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" rows="5" id="example-textarea"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Readonly</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" readonly="" value="Readonly value">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Disabled</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" disabled="" value="Disabled value">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Static control</label>
                    <div class="col-lg-10">
                        <p class="form-control-static">email@example.com</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="example-helping">Helping text</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="example-helping" placeholder="Helping text">
                        <span class="help-block"><small>A block of help text that breaks onto a new line and may extend beyond one line.</small></span>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Input Select</label>
                    <div class="col-lg-10">
                        <select class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                        <h6>Multiple select</h6>
                        <select multiple class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="example-fileinput">Default file input</label>
                    <div class="col-lg-10">
                        <input type="file" class="form-control" id="example-fileinput">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="example-date">Date</label>
                    <div class="col-lg-10">
                        <input class="form-control" id="example-date" type="date" name="date">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="example-month">Month</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="month" name="month" id="example-month">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="example-time">Time</label>
                    <div class="col-lg-10">
                        <input class="form-control" id="example-time" type="time" name="time">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="example-week">Week</label>
                    <div class="col-lg-10">
                        <input class="form-control" id="example-week" type="week" name="week">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="example-number">Number</label>
                    <div class="col-lg-10">
                        <input class="form-control" id="example-number" type="number" name="number">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">URL</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="url" name="url">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="search-input">Search</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="search" id="search-input" name="search">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="input-tel">Tel</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="tel" name="tel" id="input-tel">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-color" class="col-lg-2 col-form-label">Color</label>
                    <div class="col-lg-10">
                        <input class="form-control" id="example-color" type="color" name="color" value="#6e8cd7">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <label for="example-range" class="col-lg-2 col-form-label">Range</label>
                    <div class="col-lg-10">
                        <input class="custom-range" id="example-range" type="range" name="range" min="0" max="100">
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>