<section class="hbox stretch">
    <section>
        <section class="vbox">
            <section class="scrollable padder">
                <section class="row m-b-md">
                    <div class="col-sm-6">
                        <h3 class="m-b-xs text-black">Message Board</h3>
                        <small>Logged in Admin </small>
                    </div>
                </section>
                <div class="row">
                    <div class="col-lg-8">
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                <span class="h5 font-bold">New Message</span>
                            </header>
                            <section class="panel-body comment-list">
                                <!-- comment form -->
                                <article id="comment-form" class="comment-item media m-b-md">
                                    <form id="message_form" onsubmit="return Portal.Message.send('redirect');" action="" method="post" class="m-t-sm" action="">
                                        <div class="media-body form-group">
                                            <strong class="control-label">To</strong>
                                            <input type="email" name="email" class="form-control" />
                                        </div>
                                        <div class="media-body form-group">
                                            <strong class="control-label">Subject</strong>
                                            <input type="text" name="subject" class="form-control" />
                                        </div>
                                        <section class="media-body">
                                            <div class="form-group">
                                                <strong class="control-label">Message</strong>
                                                <textarea id="message" rows="5" name="message" placeholder="Please write your messages..." class="form-control"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary pull-right">Send Message</button>
                                        </section>
                                    </form>
                                </article>
                            </section>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </section>
</section>