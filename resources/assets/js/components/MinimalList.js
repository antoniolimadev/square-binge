import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import MinimalCard from "./MinimalCard";

class MinimalList extends Component {
    constructor(props) {
        super(props);
        this.state = {
            listId: null,
            listDetails: null,
            listItems: null,
            userId: 0
        }
    }

    getListId(){
        let url = location.pathname;
        let chunks = url.split("/");
        let index = 0;
        let myid = 0;
        chunks.forEach(element => {
            if (element === 'lists'){
                myid = chunks[index+1];
            }
            index++;
        });
        return myid;
    }

    componentDidMount() {
        let api_token = document.head.querySelector('meta[name="api-token"]');
        let listid = this.getListId();
        this.setState({ listId: listid });
        if (api_token) {
            fetch('/square-binge/public/api/lists/' + listid, {
                method: "GET",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': ' application/json',
                    'Authorization': 'Bearer ' + api_token.content
                },
            }).then(response => {
                return response.json();
            })
                .then(list => {
                    this.setState({
                        listDetails: list.details,
                        listItems: list.items
                    });
                });
        } else {
            fetch('/square-binge/public/api/lists/' + listid)
            .then(response => {
                return response.json();
            })
                .then(list => {
                    this.setState({
                        listDetails: list.details,
                        listItems: list.items
                    });
                });
        }
    }

    render() {
        if (!this.state.listItems){
            return (
                <div>
                    <br/>
                    <img src="/square-binge/public/img/loading-animation.svg"/>
                </div>
            )
        } else {
            const privateBadge = this.state.listDetails.private ? 'PRIVATE' : 'PUBLIC';
            return (
                    <div className="single-list-box">
                        <div className="single-list-header">
                            <div className="single-list-owner">
                                <div className="single-list-title">
                                    {this.state.listDetails.list_name} by &nbsp;
                                    <a href={"/square-binge/public/user/" + this.state.listDetails.owner_id}>
                                        {this.state.listDetails.owner_name}
                                    </a>
                                </div>
                                <div className="single-list-badge">{privateBadge}</div>
                            </div>
                            <div className="single-list-updated">
                                Updated <span>{this.state.listDetails.last_updated}</span>
                            </div>
                        </div>
                        <div className="single-list-wrapper">
                            <hr className="single-list-hr"></hr>
                            {this.state.listItems.map(item =>
                                <MinimalCard key={item.id} item={item}/>
                            )}
                        </div>
                    </div>
            )
        }
    }
}
export default MinimalList;
if (document.getElementById('reactList')) {
    ReactDOM.render(<MinimalList />, document.getElementById('reactList'));
}
