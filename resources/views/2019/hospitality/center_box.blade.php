<div class="container">
    <div class="row">
        <div class="col-sm-12 ">
            <!--      Wizard container        -->
            <div class="wizard-container">
                <div class="card wizard-card" data-color="purple" id="wizard">
                    <!--        You can switch " data-color="rose" "  with one of the next bright colors: "blue", "green", "orange", "purple"        -->

                    <div class="wizard-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="wizard-title">Techfest Accommodation</h3>
                                <h5>Accomodation provided by Techfest.</h5>
                            </div>
                            <div class="col-md-6">
                                <form action="hospitality/form" method="post" id="people_count">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group label-floating" style="text-align: left;">
                                                <label class="control-label"><strong>Number of People</strong></label>
                                                <select name="people" class="form-control" required>
{{--                                                    <option disabled="" selected=""></option>--}}
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <button type="submit" id="people_count" class="btn btn-fill btn-primary btn-wd">Apply for accommodation</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                    <div class="wizard-navigation">
                        <ul>
                            <li><a href="#location" data-toggle="tab">About Us</a></li>
                            <li><a href="#type" data-toggle="tab">Accomodation Policies</a></li>
                            <li><a href="#Instructions" data-toggle="tab">Instructions</a></li>
                            <li><a href="#reaching" data-toggle="tab">FAQ</a></li>
                            <li><a href="#faq" data-toggle="tab">Reaching IITB</a></li>
                            <li><a href="#contactus" data-toggle="tab">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane" id="location">
                            <div class="row">
                                <div class="col-sm-12 ">
                                    <p>Techfest has been an example in achieving huge feats with
                                        unparalleled figures ever since its inception in 1998. Techfest has
                                        grown in stature in terms of its content, infrastructure and logistics.
                                        The overwhelming crowd of such a high magnitude and a world-class
                                        technological display along with a tinge of enjoyment has made our
                                        dream a technological extravaganza. With such vastness and
                                        diversity, the hospitality of the guests is of paramount importance.</p>
                                    <p>We, at Techfest, constantly strive towards the satisfaction of
                                        everyone. We shall leave no stone unturned in fulfilling the needs of a
                                        secure accommodation away from home. Along with accommodation
                                        facilities for our participants, we also set up a cafeteria serving a
                                        variety of cuisines satisfying the needs of every palate. We strive to
                                        make your stay comfortable and your experience, a memorable one.
                                        Hospitality management would be one of the prime focuses of Team
                                        Techfest 2019-20.</p>
                                    <p>   "Hope to see you at Techfest 2019-20. We will be more than happy to
                                        receive your suggestions and queries. Kindly email at
                                        hospitality@techfest.org
                                    </p>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane" id="type">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h3>Accommodation Charges</h3>
                                    <p style="text-align: left;"> Accommodation Charges
                                        Accommodation charges are INR 2100  per candidate for 5 days.
                                        Maximum of 5 nights stay allowed (1st Jan - 5th Jan).
                                        It does not include food facility. Guest can purchase their meals from
                                        the food court, night cafeteria or private hostel canteens or hostel
                                        messes at subsidized rates

                                    </p>
                                </div>
                                <div class="col-sm-4">
                                    <h3>Timings</h3>
                                    <p style="text-align: left;">
                                        Check In - Anytime after 5PM 1st January <br>
                                        Check Out - on or before 10AM 6th January
                                    </p>
                                </div>
                                <div class="col-sm-4">
                                    <h3>Cancellation Policy</h3>
                                    <p style="text-align: left;">
                                        Confirmed Accommodation can be cancelled
                                        through email only. Send an e-mail having your team ID and the
                                        number of members for whom accommodation has to be cancelled,
                                        at hospitality@techfest.org. The subject of the email should be
                                        ""Cancellation of Accommodation"" For any cancellations before
                                        deadline, 75% of the total amount shall be refunded within 10 working
                                        days after the festival. There shall be no refunds for cancellation
                                        after the deadline. Deadline of cancellation: 1st December.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="Instructions">
                            <ol>
                                <li>
                                    All guests carrying electronic items of any kind will have to declare
                                    them at the IIT Bombay main gate through a ‘Gate Pass’.
                                    The belongings will also be checked on the way out of IIT Bombay
                                    along with the ‘Gate Pass’, failing to do so will result in the
                                    belongings being impounded.</li>
                                <li>
                                    All guests will be provided with mattress. Techfest will not provide
                                    mattress cover, blankets or pillows. The guests are encouraged to
                                    arrange them on their own (if required), since the weather might get
                                    cold during the night.</li>
                                <li>
                                    Any commodities issued to the guests would have to be returned in
                                    sound condition to the organisers during check-out.
                                    </li>
                                <li>
                                    Random checks would be made to avoid any illegal stay at the
                                    campus. Any team failing to produce their electronic/physical
                                    receipts of accommodation would be heavily fined and disqualified.
                                </li>
                                <li>
                                    Entry will be only through the 'Main Gate' of IIT Bombay.
                                    All other gates will be closed for entry.</li>
                                <li>
                                    All guests are required to carry their valid government photo id proofs at all
                                    times. In addition, the student participants are also required to carry their valid
                                    College photo id card. Any guest failing to produce their id card will not be
                                    permitted inside the campus during Techfest 2019-2020.
                                </li>
                                <li>
                                    Alcohol, drugs, sharp objects and explosives of any kind are
                                    strictly prohibited inside the campus. Any other item if deemed
                                    unsafe will be prohibited. The decision of Security and Techfest
                                    team will be final in case of any disputes.
                                </li>
                                <li>
                                    No outside vehicles will be allowed into the campus during the
                                    Techfest 2019-20."
                                </li>
                                <li>
                                    All guests are required to maintain the decorum and cleanliness of the
                                    campus, and follow the rules of the campus at all times.

                                </li>
                                <li>
                                    Techfest 2019-20 and IIT Bombay will not be responsible for
                                    any mishaps that occur through the duration of stay for Techfest 2019-20.
                                </li>
                            </ol>
                        </div>
                        <div class="tab-pane" id="faq">
                            <ol>
                                <li>
                                    "Travelling in Mumbai is very easy and systematic. The modes of travelling in Mumbai are taxis, auto rickshaws, local train and BEST Buses. IIT Bombay is located at Powai, which is an eastern suburb in the North-Eastern part (Central Railway Line) of Mumbai.
                                </li>
                                <li>

                                    The following <a href="https://wonderfulmumbai.com/latest-mumbai-auto-rickshaw-and-taxi-fare-card-tariff-card/">link</a> may provide you a rough estimate of the auto fares between two stations Taxi Auto fare
                                </li>
                                <li>
                                    Mumbai is in the form of a long narrow island, almost a peninsula, thrusting southwards into the Arabian Sea. In Mumbai, local trains run through the following routes.
                                </li>
                                <li>
                                    Western Railway: Churchgate to Borivali/Virar and return.
                                    <br>Central Railway: Mumbai CST to Karjat/Kasara and return.
                                    <br>Harbour Route: Mumbai CST to Andheri and return
                                    <br>New Bombay Route: Mumbai CST to Vashi/Panvel and return.
                                    <br>Kanjur Marg, a Local Train Station is the closest local train stop to IIT Bombay. It is located on Central Railway line.
                                    <br>Kanjur Marg Local Train Station is the closest local train stop to IIT Bombay. It is located on Central Railway line. An auto rickshaw from Kanjur-Marg station to IIT Bombay Main Gate costs Rs.45 approx.
                                </li>
                                <li>
                                    Important railway stations where you can get down are (also refer map):

                                    <br>    Chhatrapati Shivaji Terminal (CST)
                                    <br>Churchgate
                                    <br>Mumbai Central
                                    <br>Dadar
                                    <br>Lokmanya Tilak Terminus
                                    <br>Thane
                                    <br>Borivali
                                    <br>Andheri
                                    <br>Bandra
                                    <br>kalyn
                                    <br>Thane is the nearest station to IIT Bombay. Next is Lokmanya Tilak Terminus (LTT) (near Kurla) and Dadar is third in this regard.
                                </li>
                                <li>
                                    The taxis ply through all of the Mumbai. Auto rickshaws ply between Bandra-Borivali and Sion-Mulund and should be preferred if you have some heavy luggage, which may otherwise cause you inconvenience while travelling by local trains and buses. In taxis, you also have an option of AC Taxis-Cool Cabs, which is a more comfortable way of travel.
                                </li>
                                <li>
                                    Trains/buses should be preferred if you carry less baggage with you, say a small bag per person. Please beware of pickpockets in locals and BEST buses.
                                </li>
                                <li>
                                    Southbound trains on all the Local train lines are more crowded in the morning and thus should be avoided if the passenger is carrying baggage. Similarly, the northbound trains in the evening are more crowded.
                                </li>
                                <li>
                                    With respect to mornings at Kanjurmarg station, travelling from Mumbai CST, Dadar or Kurla would be less crowded that travelling from Kalyan or Thane.
                                </li>
                                <li>
                                    For buses/autorickshaws, the destination should be stated as ""IIT Main Gate, Powai"".
                                </li>
                                <li>
                                    Please download m-indicator mobile application for hands-on maps & routes of Mumbai
                                </li>
                            </ol>
                        </div>
                        <div class="tab-pane" id="reaching">
                            <ol>
                                <li>
                                    Is team ID same as ticket ID?
                                    <br>A - No, team ID and ticket ID are different numbers. To apply for accommodation you need to enter your team ID.
                                </li>
                                <li>
                                    I've registered for a workshop but I'm unable to find my team ID. How do I get my team ID?
                                    <br>A - Goto <a href="/workshops"></a>techfest.org/workshops. Goto the workshop you have registered for. Click on register. It asks for your email address. Use the same email address as you have used earlier. After login, on the top right corner it will show your team id
                                </li>
                                <li>
                                    How to avail accommodation?
                                    <br>Step1) Go to URL and fill the registration form
                                    <br>Step2) Complete the payment procedure.
                                    <br>Step3) Confirmation will be sent to you
                                    <br>Step4) Report at accommodation desk
                                    <br>
                                </li>
                                <li>
                                    What is the payment procedure?
                                    <br>The payment procedure will be online.
                                    <br>The accommodation charges are provided under the tab Accommodation Charges on the hospitality page. You will have to report at the accommodation desk near the Old Swimming Pool with the email print out and the mandatory documents. Failing to bring any of the documents may lead to cancellation of your accommodation.
                                    <br>
                                </li>
                                <li>
                                    How do I know whether my payment is confirmed?
                                    <br>Confirmation is not confirmed till confirmation mail is not received in 24 hours
                                    <br>If not received confirmation in 24 hours then mail your transaction ID, Techfest ID, name, amount to hospitality@techfest.org with subject as (Transaction ID :: team ID ::Confirmation mail not received).
                                    <br>
                                </li>
                                <li>
                                    Documents that guests should carry?
                                    <br>Any valid Govt photo ID
                                    <br>Print out of Email confirmation
                                    <br> Gate pass
                                    <br>Valid College ID for participants
                                    <br>
                                </li>
                                <li>
                                    Shall I carry my ID card with me?
                                    <br>It is mandatory for all guest participants to carry college IDs. This is for your own convenience. Moreover, you will be asked to produce your college ID cards at the time of allotment of rooms.
                                    <br>
                                </li>
                                <li>
                                    What are the accommodation charges?
                                    <br>The accommodation charges and other necessary details regarding the payment will be available under the tab Accommodation Charges.
                                    <br>
                                </li>
                                <li>
                                    Will all the team members be given accommodation at the same place?
                                    <br>We will try but there is no surety for the same.
                                    <br>Outstation guest who have registered for accommodation are requested to report to the accommodation desk (near Old Swimming Pool IITB) where the required formalities involving checking of documents, allotment of rooms will be done.
                                    <br>
                                </li>
                                <li>
                                    What kind of accommodation is provided?
                                    <br>Accommodation is provided on a shared basis inside campus hostels or outside hotels. One mattress, and an enough space for keeping luggage, and other essential commodities will be provided. Girls and boys will be accommodated separately. Number of guest in a room will be decided by Techfest and will be allotted by Techfest team.
                                </li>
                                <li>
                                    Does the accommodation charges include food facilities too?
                                    <br>No, the accommodation charges does not include food facilities. Guest can purchase their meals from the food court, night cafeteria or private hostel canteens or hostel messes
                                    <br>
                                </li>
                                <li>
                                    Do we get any food facilities at outside accommodation places?
                                    <br>You can purchase your meals from the hotels or the nearby restaurants.
                                    <br>
                                </li>
                                <li>
                                    What are the food facilities inside the campus?
                                    <br>For all our guests and guest we set up a huge cafeteria serving a variety of cuisines satisfying the needs of every palate. In addition, you can also eat in the many canteens, messes, and restaurant inside the campus.
                                    <br>
                                </li>
                                <li>
                                    What abot the hospital facility?
                                    <br>There is an institute Hospital located near the Canara Bank. In case you fall ill, you are advised to report to us at accommodation desk. We shall make appropriate arrangements for you to be treated at the Institute hospital. We shall also be carrying a first aid kit with us, at the accommodation desk.
                                    <br>
                                </li>
                                <li>
                                    What about the security facilities?
                                    <br>IIT Bombay campus has a vigilant and round-the-clock security service. To ensure the safety of the participants, there will be additional security guards in hostels in order to avoid thefts and other mishaps. Although Techfest team will not take responsibility for any theft or other mishaps. So guest are requested to take care of their luggage and valuable items.
                                    <br>
                                </li>
                                <li>
                                    Where will I get my accommodation?
                                    <br>You might get accommodation outside as well as inside the campus depending upon availability, however, girls with confirmed accommodation will get accommodation inside the IIT-B campus only.
                                    <br>
                                </li>
                                <li>
                                    Can I enter IIT-B campus anytime?
                                    <br>You can enter IIT Main gate anytime by showing valid photo ID proof during 6am to 10pm, however, you need to have accommodation inside the campus to stay in the campus after 10pm.
                                    <br>
                                </li>
                                <li>
                                    We are a group of people not participating in any of competitions or workshops and just coming to techfest for enjoyment. Would we be provided accommodation?
                                    <br>No, Accommodation would be confirmed strictly subject to availability of rooms.
                                    <br>
                                </li>
                                <li>
                                    Where do I have to report during the fest?
                                    <br>You need to come to the Hospitality Desk at the Old SAC
                                    <br>
                                </li>
                            </ol>
                        </div>
                        <div class="tab-pane" id="contactus">
                            <div class="row">
                                <h4 class="info-text"> Feel Free to contact us </h4>
                                <p class="description">Aman Bhargava</p>
                                <p class="description">+91 8805872303</p>
                                <br>
                                <p class="description">Prasanna </p>
                                <p class="description">+91 9172585090</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- wizard container -->
        </div>
    </div> <!-- row -->
</div> <!--  big container -->

</div>
