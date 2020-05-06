
    $(document).ready()
    {
        $(function() {
            $('#people-list li').on("click",function(e) {
                console.log(e);
                console.log(this);
                this.classList.toggle("active");
            });
        });

        //Filter list based on search box
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#people-list li").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        //Filter list based on Tag selection
        $('#peoplepicker_tag').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue){

            //Find the values of the tags
            var values = [$(this).find("option:selected").text()];
            values = values.join(" ").split(' ').filter(Boolean);

            console.log(values);

            //Filter the list based on the presence of each tag
            $("#people-list li").filter(function() {
                var toggle = true;
                for(i=0; i< values.length; i++) {
                    if ( !$(this).html().includes(values[i]))
                    {
                        toggle = false;
                    }
                }
                $(this).toggle(toggle);
            })
            
        });

        //Action when the save button is pushed
        $(function() {
            $("#modal-btn-save").on("click",function(e) {
                //Get all the "active" elements
                var x = document.getElementById("people-list").querySelectorAll(".active"); 
                
                //Add the person to the list
                var people_div = document.getElementById("people");
                //Remove all children
                people_div.innerHTML = "";


                //Iterate and extract the person_id
                for( i=0; i < x.length; i++)
                {
                    var id = x[i].getAttribute("data-id");
                    var name = x[i].getAttribute("data-name");

                    console.log( x[i].getAttribute("id") );

                    
                    //Build element to show person
                    var divElement = document.createElement("div");
                        divElement.classList.add("p-1");
                    var aElement = document.createElement("a");
                        var url = "{{route('event-person.show', ':id')}}";
                        url = url.replace(':id', id);
                        aElement.setAttribute("href", url );
                        var a_html = '<input type="hidden" name="people[]" value=';
                        aElement.innerHTML = a_html.concat(id,'>', name);
                        divElement.appendChild(aElement);
                    people_div.appendChild(divElement);
                    
                }

                //dismiss Modal
                $('#peoplepickermodal').modal('hide');
            });
        });
    }
