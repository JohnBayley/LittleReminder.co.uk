<div id="leftBar">
<div class="titleBar ui-corner-all">Repeats</div>
    <div class="linkHolder ui-corner-all">
        <a href="/personalReminders/repeats.php?all=true" title="Show All your Reminders"><img src="/images/fam/date.png" alt="All" />All Reminders</a>
        <br />
        <a href="/personalReminders/repeats.php?expired=true" title="Show Expired Reminders"><img src="/images/fam/dateExpired.png" alt="Expired" /> Expired Reminders</a>
        <br />
        <a href="/personalReminders/repeats.php?thisYear=true" title="Show this years Reminders"><img src="/images/fam/date12m.png" alt="This Year" /> This Years Reminders</a>
        <br />
        <a href="/personalReminders/repeats.php?lastYear=true" title="Show last years Reminders"><img src="/images/fam/date12m.png" alt="Last Year" /> Last Years Reminders</a>
        <br />	
        <a href="/personalReminders/repeats.php?future=true" title="Show future Reminders"><img src="/images/fam/date_next.png" alt="Future" /> Future Reminders</a>
        <br />
        <br />
        <hr />
        <br />
        <a href="/personalReminders/repeats.php?period=365" title="Show annual Reminders"><img src="/images/fam/date.png" alt="Annual" /> Annual Reminders</a>
        <br />
        <a href="/personalReminders/repeats.php?period=30" title="Show annual Reminders"><img src="/images/fam/date.png" alt="Annual" /> Monthly Reminders</a>
        <br />        
        <hr/>
        <br />
        <img src="/images/fam/date_magnify.png" alt="Search" /> Description Search
        <br />
        <form action="repeats.php" method="post">
            <fieldset class="rmSearchHolder ui-corner-all">
                <input type="text" class="leftSearch" id="descriptionSearch" name="descriptionSearch" value="" title="Search using description" />
                <input type='image' src="/images/go.gif" />
            </fieldset>
        </form>
    </div>
    <span id="leftinfo">Found ? Reminders</span>
</div>
