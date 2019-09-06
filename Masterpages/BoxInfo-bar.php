                    <div class="box info-bar">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 products-showing">
                                <p id ="showingProduct" style="display">Showing 6 of 12 products</p>
                            </div>

                            <div class="col-sm-12 col-md-8  products-number-sort">
                                <div class="row">
                                    <form class="form-inline">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="products-number">
                                                <strong>Show</strong>  <a id="show6" onclick="showAmount('6')" href="#" class="btn btn-default btn-sm btn-primary">6</a> <a id="show12" onclick="showAmount('12')" href="#" class="btn btn-default btn-sm">12</a> <a id= "showAll" onclick="showAmount('all')" href="#" class="btn btn-default btn-sm">All</a> products
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="products-sort-by">
                                                <strong>Sort by</strong>
                                                <select name="sort-by" class="form-control">
                                                    <option id="sortLow" onclick="sort('low')">Price: low-high</option>
													<option id= "sortHigh" onclick="sort('high')">Price: high-low</option>
                                                    <!--<option>Sales first</option>-->
                                                </select>
												<p id= "sortValue" hidden></p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>