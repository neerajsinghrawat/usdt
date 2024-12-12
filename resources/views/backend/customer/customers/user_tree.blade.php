@extends('backend.layouts.app')
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .aiz-titlebar {
        background-color: #0056b3;
        color: white;
        padding: 10px 20px;
    }

    .card {
        margin: 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .card-header {
        background-color: #f8f8f8;
        border-bottom: 1px solid #ddd;
    }

    .card-body {
        padding: 20px;
    }

    h2.text-center {
        margin-bottom: 20px;
        color: #333;
    }

    #tree-container {
        width: 100%;
        height: 600px; /* Set height to a fixed value */
        overflow: auto;
        border: 1px solid #ddd;
        background-color: #f9f9f9;
        margin-top: 20px;
        border-radius: 5px;
        padding: 10px;
    }

    .node circle {
        fill: #6bbf59;
        stroke: #333;
        stroke-width: 2px;
        transition: transform 0.3s;
    }

    .node.highlight circle {
        fill: #ff7f0e; /* Orange for highlighted nodes */
    }

    .node:hover circle {
        transform: scale(1.2);
    }

    .node text {
        font-size: 10px;
        font-weight: bold;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        width: 100px;
        display: inline-block;
        color: #333;
    }

    .link {
        fill: none;
        stroke: #888;
        stroke-width: 2px;
        transition: stroke 0.3s;
    }

    .left-link {
        stroke: #1f77b4; /* Blue color for left links */
    }

    .right-link {
        stroke: #ff7f0e; /* Orange color for right links */
    }

    .form-group input {
        border-radius: 5px;
        padding: 10px;
    }

    .form-control {
        font-size: 14px;
    }

    .form-group .btn {
        padding: 8px 16px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .form-group .btn:hover {
        background-color: #0056b3;
    }
</style>

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="align-items-center">
        <h1 class="h3">{{translate('All Members')}}</h1>
    </div>
</div>

<div class="card">
    <form class="" id="sort_customers" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col">
                <h5 class="mb-0 h6">{{translate('Members')}}</h5>
            </div>

            <div class="col-md-3">
                <div class="form-group mb-0">
                    <input type="text" class="form-control" id="search" name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type email or name & Enter') }}">
                </div>
            </div>
        </div>

        <div class="card-body">
            <h2 class="text-center">Interactive User Hierarchy Tree</h2>
            <div id="tree-container"></div>

            <script src="https://d3js.org/d3.v6.min.js"></script>
            <script>
                // Convert the PHP user tree data to a JavaScript object
                const treeData = {!! json_encode($userTree) !!};

                const margin = { top: 20, right: 120, bottom: 20, left: 120 };
                const width = window.innerWidth - margin.left - margin.right;
                const height = 1200 - margin.top - margin.bottom;

                const treeLayout = d3.tree().size([height, width]);

                const svg = d3.select("#tree-container").append("svg")
                    .attr("width", "100%")
                    .attr("height", height + margin.top + margin.bottom)
                    .append("g")
                    .attr("transform", `translate(${margin.left},${margin.top})`);

                const root = d3.hierarchy(treeData);
                treeLayout(root);

                svg.selectAll(".link")
                    .data(root.links())
                    .enter().append("path")
                    .attr("class", "link")
                    .attr("class", d => {
                        const source = d.source;
                        const target = d.target;
                        return target.x < source.x ? "link left-link" : "link right-link";
                    })
                    .attr("d", d3.linkVertical()
                        .x(d => d.x)
                        .y(d => d.y));

                const node = svg.selectAll(".node")
                    .data(root.descendants())
                    .enter().append("g")
                    .attr("class", "node")
                    .attr("transform", d => `translate(${d.x},${d.y})`)
                    .attr("class", d => {
                        // Add 'highlight' class if depth is 3 or less
                        return d.depth <= 3 ? "node highlight" : "node";
                    });

                node.append("circle")
                    .attr("r", 10);

                    node.append("text")
                    .attr("dy", 3)
                    .attr("x", d => d.children ? -15 : 15)
                    .style("text-anchor", d => d.children ? "end" : "start")
                    .text(d => {
                        const relationship = d.data.relationship ? ` (${d.data.relationship})` : '';
                        const referrerName = d.data.referrer_name ? ` [Ref: ${d.data.referrer_name}]` : '';
                        return `${d.data.user_name}${referrerName}${relationship}`;
                    });


                const zoom = d3.zoom()
                    .scaleExtent([0.5, 2])
                    .on("zoom", (event) => {
                        svg.attr("transform", event.transform);
                    });

                d3.select("#tree-container svg").call(zoom);
            </script>
        </div>
    </form>
</div>

@endsection
