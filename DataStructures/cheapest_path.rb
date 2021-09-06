# frozen_string_literal: true

# @Author: jamshadahmad.se@gmail.com

# class for implementing shortest path finding algorithm
class Graph
  INFINITY = 1 << 64

  def initialize
    @graph = {} # to store whole graph
    @nodes = [] # just to store nodes
    @costs = {} # stores minimum cost to the destination
    @prev = {} # stores previous element for the minimum cost
  end

  # Adds a uni-directional path from source to target
  def add_path(source, target, cost)
    if !@graph.key?(source)
      @graph[source] = { target => cost }
    else
      @graph[source][target] = cost
    end

    @nodes << source unless @nodes.include?(source)
    @nodes << target unless @nodes.include?(target)
  end

  # Initializes @costs and @prev before running dijkstra algorithm
  def initialize_costs(start)
    @nodes.each do |i|
      @costs[i] = INFINITY
      @prev[i] = -1
    end

    @costs[start] = 0
  end

  # Based on https://en.wikipedia.org/wiki/Dijkstra%27s_algorithm
  def dijkstra(start)
    initialize_costs(start)
    # remaining is remaining nodes to visit
    remaining = @nodes.compact
    until remaining.empty?
      current = nil
      remaining.each do |min|
        current = min if !current || (@costs[min] && (@costs[min] < @costs[current]))
      end
      break if @costs[current] == INFINITY # no path for current node

      remaining -= [current]
      next if @graph[current].nil? # if there are no outwards routes from current

      @graph[current].each_key do |prev|
        alt_cost = @costs[current] + @graph[current][prev]
        # update @prev and @costs if cheaper alternative path found
        if alt_cost < @costs[prev]
          @costs[prev] = alt_cost
          @prev[prev] = current
        end
      end
    end
  end

  def print_path(dest)
    print_path @prev[dest] if @prev[dest] != -1
    print "> #{dest} "
  end

  def print_cost(dest)
    puts "Cost: #{@costs[dest]}"
  end
end

world = Graph.new

world.add_path('JFK', 'ATL', 150)
world.add_path('ATL', 'SFO', 400)
world.add_path('ORD', 'LAX', 200)
world.add_path('LAX', 'DFW', 80)
world.add_path('JFK', 'HKG', 800)
world.add_path('ATL', 'ORD', 90)
world.add_path('JFK', 'LAX', 500)

world.dijkstra('JFK')

world.print_path('LAX')
world.print_cost('LAX')
